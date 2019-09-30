<?php namespace Arcanesoft\Blog\Http\Controllers;

use Arcanesoft\Blog\Http\Requests\Authors\CreateAuthorRequest;
use Arcanesoft\Blog\Models\Author;
use Arcanesoft\Blog\Policies\PostsPolicy;
use Arcanesoft\Blog\Repositories\AuthorsRepository;
use Arcanesoft\Foundation\Concerns\HasNotifications;

/**
 * Class     AuthorsController
 *
 * @package  Arcanesoft\Blog\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('blog::main.authors');
        $this->addBreadcrumbRoute(__('Authors'), 'admin::blog.authors.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(PostsPolicy::ability('index'));

        return $this->view('authors.index');
    }

    public function metrics()
    {
        $this->authorize(PostsPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::blog.authors.metrics');

        $this->selectMetrics('arcanesoft.blog.metrics.posts');

        return $this->view('authors.metrics');
    }

    public function create()
    {
        $this->authorize(PostsPolicy::ability('create'));

        return $this->view('authors.create');
    }

    public function store(CreateAuthorRequest $request, AuthorsRepository $repo)
    {
        $this->authorize(PostsPolicy::ability('create'));

        $author = $repo->create($request->getValidatedData());

        $this->notifySuccess(
            __('Author Created'),
            __('The author has been successfully created!')
        );

        return redirect()->route('admin::blog.authors.show', [$author]);
    }

    public function show(Author $author)
    {
        $this->authorize(PostsPolicy::ability('show'));

        $this->addBreadcrumbRoute(__("Author's details"), 'admin::blog.authors.show', [$author]);

        return $this->view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        $this->authorize(PostsPolicy::ability('update'));

        $this->addBreadcrumbRoute(__('Edit Author'), 'admin::blog.authors.edit', [$author]);

        return $this->view('authors.edit', compact('author'));
    }

    public function update(Author $author)
    {
        $this->authorize(PostsPolicy::ability('update'));

        $this->notifySuccess(
            __('Author Updated'),
            __('The author has been successfully updated!')
        );

        return redirect()->route('admin::blog.authors.show', [$author]);
    }

    public function delete(Author $author, AuthorsRepository $repo)
    {
        $this->authorize(PostsPolicy::ability('delete'));

        $repo->delete($author);

        $this->notifySuccess(
            __('Author Deleted'),
            __('The author has been successfully deleted!')
        );

        return $this->jsonResponseSuccess();
    }
}
