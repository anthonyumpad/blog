<?php
/**
 * CategoryController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use View;
use Log;
use App\Services\CategoryValidator;
use App\Exceptions\ValidationException;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 *
 * This handles all Category requests
 */
class CategoryController extends Controller
{

    /**
     * constructor
     *
     * Inject some dependency
     */
    public function __construct(CategoryValidator $categoryValidator, CategoryRepository $categoryRepository)
    {
        $this->categoryValidator  = $categoryValidator;
        $this->categoryRepostory  = $categoryRepository;
    }
    /**
     * all
     *
     * This renders the categories index page
     *
     * @return \Illuminate\View\View
     */
    public function all(Request $request)
    {
        $categories = $this->categoryRepostory->paginatedList($request);
        $data = [
            'categories'  => $categories,
            'limit'  => (! empty($request->get('limit')))   ? $request->get('limit') : 5,
            'sortBy' => (! empty($request->get('sortBy'))) ? $request->get('sortBy') : 'sortByNameAsc',
        ];

        if (Session::has('flash_message')) {
            $data['flash_message'] = Session::get('flash_message');
        }

        return View::make('admin.category.list')
            ->with($data);
    }

    /**
     * createAction
     *
     * This renders the category create page
     *
     * @return \Illuminate\View\View
     */
    public function createAction()
    {
        return View::make('admin.category.create-update')
            ->with('action', 'Create');
    }

    /**
     * create
     *
     * This creates a new category
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request)
    {
        try {
            $this->categoryValidator->validate($request->all());
        } catch (ValidationException $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
            'Create post validation exception.', ['exception', $e->get_errors()]);
            return View::make('admin.category.create-update')
                ->with([
                    'flash_message' => [
                        'status'  => 'error',
                        'message' => $e->get_errors()
                    ],
                    'action' => 'Create'
                ]);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post  exception.', ['exception', $f->getMessage()]);
            return View::make('admin.category.create-update')
                ->with([
                    'flash_message' => [
                        'status'  => 'error',
                        'message' => $e->getMessage()
                    ],
                    'action' => 'Create'
                ]);
        }

        try {
            $this->categoryRepostory->createUpdate($request);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post  exception.', ['exception', $f->getMessage()]);
            return View::make('admin.category.create-update')
                ->with([
                    'flash_message' => [
                        'status'  => 'error',
                        'message' => $e->getMessage()
                    ],
                    'action' => 'Create'
                ]);
        }

        return Redirect::route('admin.category.list')->with('flash_message', [
            'status'  => 'success',
            'message' => 'Category '. $request->get('name') .' was successfully added/updated.'
        ]);
    }

    /**
     * edit
     *
     * This renders the category edit page
     *
     * @return \Illuminate\View\View
     */
    public function editAction($categoryId)
    {
        if (empty($categoryId)) {
            return View::make('admin.category.create-update')
                ->with('action', 'Create');
        }

        $category = Category::find($categoryId);
        if (empty($category)) {
            return View::make('admin.category.create-update')
                ->with('action', 'Create');
        }

        return View::make('admin.category.create-update')
            ->with([
                'category' => $category,
                'action'   => 'Edit'
            ]);
    }
}
