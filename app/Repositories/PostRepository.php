<?php
/**
 * Class PostRepository
 *
 * @author Anthony
 */

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class PostRepository
 *
 * This performs all Post related data request
 */
class PostRepository
{
    /**
     * paginatedList
     *
     * This queries and returns a paginated list of posts
     *
     * @param Request $request
     * @return Post(Collection)
     * @throws Exception
     */
    public function paginatedList(Request $request)
    {
        $user = Sentinel::getUser();
        $limit  = (! empty($request->get('limit')))  ? $request->get('limit')  : 10;
        $sortBy = (! empty($request->get('sortBy'))) ? $request->get('sortBy') : 'sortByDateDesc';
        /*
            sortByDateDesc
            sortByDateAsc
            sortByCategory
        */
        $posts  = Post::where('user_id', $user->id)
            ->with('category');

        if ($sortBy == 'sortByDateDesc') {
            $posts->orderBy('created_at', 'desc');
        } elseif($sortBy == 'sortByDateAsc') {
            $posts->orderBy('created_at', 'asc');
        } elseif($sortBy == 'sortByCategory') {
            $posts->orderBy('category_id', 'asc');
        }


        $posts = $posts->paginate((int) $limit);
        return $posts;
    }

    /**
     * createUpdate
     *
     * This creates or updates a blog
     *
     * @param Request $request
     * @return Post
     * @throws Exception
     */
    public function createUpdate(Request $request)
    {
        Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
            'Create or update post.', ['request', $request->all()]);

        $data   = $request->except(['_url', '_token', 'uid']);
        $uid    = $request->get('uid');
        $postId = (! empty($data['post-id'])) ? $data['post-id'] : null;
        $user   = User::where('uid', $uid)->first();

        if (empty($user)) {
            throw new \Exception('User not found.');
        }

        $post = null;
        if (empty($postId)) {
            $post         =  new Post();
            $post->status =  Post::STATUS_DRAFT;
        } else {
            $post = Post::find($postId);
            if (empty($post)) {
                throw new \Exception ('Post '. $postId . ' does not exist.');
            }
            $post->status       = (! empty($data['status']))  ? $data['status'] : Post::STATUS_DRAFT;
        }

        //update stuff here
        $post->user_id     = $user->id;
        $post->title       = (isset($data['title']))       ? $data['title']       : '';
        $post->category_id = (isset($data['category_id'])) ? $data['category_id'] : '';
        $post->description = (isset($data['description'])) ? $data['description'] : '';
        $post->tags        = (isset($data['tags']))        ? $data['tags']        : '';
        $post->content     = (isset($data['content']))     ? $data['content']     : '';

        if ($post->status == Post::STATUS_PUBLISHED) {
            $post->published_at = new \DateTime();
        }

        try {
            $post->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $post;
    }

    /**
     * delete
     *
     * This deletes the post
     *
     * @param $postId
     * @throws exception
     */
    public function delete($postId)
    {
        $post = Post::find($postId);
        if (empty($post)) {
            throw new \Exception ('Post '. $postId . ' does not exist.');
        }
        
        try {
            $post->delete();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }
}