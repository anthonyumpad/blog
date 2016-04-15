<?php
/**
 * Class PostRepository
 *
 * @author Anthony
 */

namespace App\Repositories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

/**
 * Class CategoryRepository
 *
 * This performs all Category related data request
 */
class CategoryRepository
{
    /**
     * paginatedList
     *
     * This queries and returns a paginated list of categorys
     *
     * @param Request $request
     * @return Category(Collection)
     * @throws Exception
     */
    public function paginatedList(Request $request)
    {
        $user = Sentinel::getUser();
        $limit  = (! empty($request->get('limit')))  ? $request->get('limit')  : 5;
        $sortBy = (! empty($request->get('sortBy'))) ? $request->get('sortBy') : 'nameAsc';
        /*
            sortByNameAsc
            sortByNameDesc
        */
        $categories  = Category::where('user_id', $user->id);
        if ($sortBy == 'sortByNameAsc') {
            $categories->orderBy('name', 'asc');
        } elseif($sortBy == 'sortByNameDesc') {
            $categories->orderBy('name', 'desc');
        }

        $categories = $categories->paginate((int) $limit);
        return $categories;
    }

    /**
     * createUpdate
     *
     * This creates or updates a blog catgory
     *
     * @param Request $request
     * @return Category
     * @throws Exception
     */
    public function createUpdate(Request $request)
    {
        $data       = $request->except(['_url', '_token', 'uid']);
        $uid        = $request->get('uid');
        $categoryId = (! empty($data['category-id'])) ? $data['category-id'] : null;
        $user   = User::where('uid', $uid)->first();

        if (empty($user)) {
            throw new \Exception('User not found.');
        }

        $category = null;
        if (empty($categoryId)) {
            $category         =  new Category();
        } else {
            $category = Category::find($categoryId);
            if (empty($category)) {
                throw new \Exception ('Category '. $categoryId . ' does not exist.');
            }
        }

        //update stuff here
        $category->user_id     = $user->id;
        $category->name        = (isset($data['name']))       ? $data['name']       : '';

        try {
            $category->save();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $category;
    }
}