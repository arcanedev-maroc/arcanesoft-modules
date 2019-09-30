<?php namespace Arcanesoft\Foundation\Http\Controllers\System;

use Arcanedev\LogViewer\Contracts\LogViewer;
use Arcanedev\LogViewer\Entities\LogEntry;
use Arcanedev\LogViewer\Exceptions\LogNotFoundException;
use Arcanedev\LogViewer\Tables\StatsTable;
use Arcanesoft\Foundation\Concerns\HasNotifications;
use Arcanesoft\Foundation\Policies\System\LogViewerPolicy;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\{Arr, Collection, Str};

/**
 * Class     LogViewerController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\LogViewer\Contracts\LogViewer */
    protected $logViewer;

    /** @var int */
    protected $perPage = 30;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(LogViewer $logViewer)
    {
        $this->logViewer = $logViewer;

        parent::__construct();

        $this->addBreadcrumbRoute(__('LogViewer'), 'admin::foundation.system.log-viewer.index');
        $this->setCurrentSidebarItem('foundation::system.log-viewer');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(LogViewerPolicy::ability('index'));

        $chartData = $this->prepareChartData($stats = $this->logViewer->statsTable());
        $percents  = $this->calculatePercentages($stats->footer(), $stats->header());

        return $this->view('system.log-viewer.index', compact('percents', 'chartData'));
    }

    public function logs(Request $request)
    {
        $this->authorize(LogViewerPolicy::ability('index'));

        $stats   = $this->logViewer->statsTable();
        $headers = $stats->header();
        $rows    = $this->paginate($stats->rows(), $request);

        $this->addBreadcrumbRoute(__('Logs'), 'admin::foundation.system.log-viewer.logs.index');

        return $this->view('system.log-viewer.logs', compact('headers', 'rows'));
    }

    public function showLog(Request $request, string $date)
    {
        return $this->filter($request, $date, 'all');
    }

    public function search(Request $request, string $date, string $level)
    {
        return $this->filter($request, $date, $level);
    }

    public function filter(Request $request, string $date, string $level)
    {
        $this->authorize(LogViewerPolicy::ability('show'));

        $this->addBreadcrumbRoute(__('Logs'), 'admin::foundation.system.log-viewer.logs.index');
        $this->addBreadcrumbRoute($date, 'admin::foundation.system.log-viewer.logs.show', [$date]);

        $log     = $this->getLogOrFail($date);
        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries($level)
            ->unless(is_null($query = $request->get('query')), function ($entries) use ($query) {
                return $entries->filter(function (LogEntry $value) use ($query) {
                    return Str::contains($value->header, $query);
                });
            })
            ->paginate($this->perPage);

        return $this->view('system.log-viewer.show', compact('level', 'log', 'query', 'levels', 'entries'));
    }

    public function download(string $date)
    {
        $this->authorize(LogViewerPolicy::ability('download'));

        return $this->logViewer->download($date);
    }

    public function delete(string $date)
    {
        $this->authorize(LogViewerPolicy::ability('delete'));

        if ( ! $this->logViewer->delete($date))
            return $this->jsonResponseError();

        $this->notifySuccess(__('Log Deleted'), __('The log file has been successfully deleted!'));

        return $this->jsonResponseSuccess();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the chart data.
     *
     * @param  \Arcanedev\LogViewer\Tables\StatsTable  $stats
     *
     * @return array
     */
    protected function prepareChartData(StatsTable $stats): array
    {
        $totals = $stats->totals()->all();

        return [
            'labels'   => Arr::pluck($totals, 'label'),
            'datasets' => [
                [
                    'data'                 => Arr::pluck($totals, 'value'),
                    'backgroundColor'      => Arr::pluck($totals, 'color'),
                    'hoverBackgroundColor' => Arr::pluck($totals, 'highlight'),
                ],
            ],
        ];
    }

    /**
     * Calculate the percentages.
     *
     * @param  array  $total
     * @param  array  $names
     *
     * @return array
     */
    protected function calculatePercentages(array $total, array $names)
    {
        $percents = [];
        $all      = Arr::get($total, 'all');

        foreach ($total as $level => $value) {
            $percents[$level] = [
                'name'    => $names[$level],
                'value'   => $value,
                'percent' => $all !== 0 ? round(($value / $all) * 100, 2) : 0,
            ];
        }

        return $percents;
    }

    /**
     * Paginate logs.
     *
     * @param  array                     $data
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginate(array $data, Request $request)
    {
        $data = new Collection($data);
        $page = $request->get('page', 1);
        $path = $request->url();

        return new LengthAwarePaginator(
            $data->forPage($page, $this->perPage),
            $data->count(),
            $this->perPage,
            $page,
            compact('path')
        );
    }

    /**
     * Get a log or fail
     *
     * @param  string  $date
     *
     * @return \Arcanedev\LogViewer\Entities\Log|null
     */
    protected function getLogOrFail($date)
    {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        }
        catch (LogNotFoundException $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }
}
