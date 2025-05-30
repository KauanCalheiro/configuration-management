<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\ResponseService;
use Exception;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        try {
            $users = QueryBuilder::for(User::class)
                ->allowedFilters([
                    AllowedFilter::exact('id'),
                    'name',
                    'email',
                ])
                ->allowedSorts([
                    'id',
                    'name',
                    'email',
                ])
                ->jsonPaginate();

            return ResponseService::success(data: $users, count: $users->toArray()['total']);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) {
        try {
            $user = User::create($request->validated());
            return ResponseService::success(data: $user);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {
        try {
            $user->load(request('with', []));
            return ResponseService::success(data: $user);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user) {
        try {
            $user->update($request->validated());
            return ResponseService::success(data: $user);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {
        try {
            if ($user->id === auth()->user()->id) {
                throw new Exception('You cannot delete your own account', 403);
            }

            $user->delete();
            return ResponseService::success($user);
        } catch (Exception $e) {
            return ResponseService::error($e);
        }
    }
}
