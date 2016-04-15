<?php
/**
 * PostController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use App\Exceptions\ValidationException;
use App\Services\PostValidator;
use App\Repositories\PostRepository;
use App\Models\Post;
use View;
use Log;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 *
 * This handles all Post requests
 */
class PostController extends Controller
{

    /**
     * constructor
     *
     * Inject some dependency
     */
    public function __construct(PostValidator $postValidator, PostRepository $postRepository)
    {
        $this->postValidator  = $postValidator;
        $this->postRepository = $postRepository;
    }

    /**
     * all
     *
     * This renders the posts index page
     *
     * @return \Illuminate\View\View
     */
    public function all(Request $request)
    {
        $posts = $this->postRepository->paginatedList($request);
        return View::make('admin.post.list')
            ->with([
                'posts'  => $posts,
                'limit'  => (! empty($request->get('limit')))   ? $request->get('limit') : '10',
                'sortBy' => (! empty($request->get('sortBy'))) ? $request->get('sortBy') : 'sortByDateDesc',
            ]);
    }

    /**
     * createAction
     *
     * This renders the post create page
     *
     * @return \Illuminate\View\View
     */
    public function createAction()
    {
        return View::make('admin.post.create-update')
            ->with('action', 'Create');
    }

    /**
     * create
     *
     * This creates a new blog
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        // validate
        try {
            $this->postValidator->validate($request->all());
        } catch (ValidationException $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post validation exception.', ['exception', $e->get_errors()]);
            return Response::json([
                'status' => 'error',
                'message' => 'Validation Exception.',
                'error' => [
                    'errors'  => $e->get_errors()
            ], 500]);
        } catch (\Exception $f) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post  exception.', ['exception', $f->getMessage()]);
            return Response::json([
                'status' => 'error',
                'message' => 'Create Post Exception.',
                'error' => [
                    'message' =>  $f->getMessage(),
                ], 500]);
        }

        // save
        try {
            $post = $this->postRepository->createUpdate($request);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post  exception.', ['exception', $e->getMessage()]);
            return Response::json([
                'status' => 'error',
                'message' => 'Create Post Exception.',
                'error' => [
                    'message' =>  $e->getMessage(),
                ], 500]);
        }

        return Response::json([
            'status'      => 'success',
            'id'          => $post->id,
            'blog_status' => $post->status,
            'message' => 'Your post was successfully saved. ID : ' . $post->id
        ]);
    }

    /**
     * editAction
     *
     * This renders the post edit page
     *
     * @return \Illuminate\View\View
     */
    public function editAction($postId)
    {
        if (empty($postId)) {
            return View::make('admin.post.create-update')
                ->with('action', 'Create');
        }

        $blog = Post::find($postId);
        if (empty($blog)) {
            if (empty($postId)) {
                return View::make('admin.post.create-update')
                    ->with('action', 'Create');
            }
        }

        return View::make('admin.post.create-update')
            ->with([
                'action' => 'Edit',
                'blog'   => $blog
            ]);
    }
}
