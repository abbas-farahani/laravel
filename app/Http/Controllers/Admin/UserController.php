<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();

        if($keyword = request('search')){
            $users->where('email', 'LIKE', "%{$keyword}%")
                ->orwhere('name', 'LIKE', "%{$keyword}%")
                ->orwhere('id', $keyword);
        }

        if( (string) request('user_role') && request('user_role') !=='all' ){
            $users->where('user_role', request('user_role'));
        }

        $users = $users->latest()->paginate(5);
        return view( 'admin.users.all', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.users.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = User::create( $data );

        if ($request->has('verify')){
            $user->markEmailAsVerified();
        }

//        if ($request->has( ['user-role'=>'administrator'] ) ){
//            $user->is_superadmin;
//        }

        alert()->success('کاربر جدید ایجاد شد.');
        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return User|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
//        return $user;
//        return view( 'admin.users.edit', ['user' => $user->id] );
        return view( 'admin.users.edit', compact('user') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        if( ! is_null( $request->password ) ){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $data['password'] = $request->password;
        }

        if ($request->has('verify')){
            $user->markEmailAsVerified();
        }

        $user->update($data);

        alert()->success('بروزرسانی انجام شد.');
        return redirect((route('admin.users.index')));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return string
     */
    public function destroy(User $user)
    {
        if( ! is_null($user)){
            $user->delete();
            alert()->success('کاربر حذف شد.');
            return back();
        }else{
            return 'nothing happened!';
        }
    }
}
