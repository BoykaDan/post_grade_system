<?php

namespace App\Http\Controllers\Admin;


use App\Jobs\PostFromFields;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\UploadController;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        return view('admin.post.index')
            ->withPosts(Post::all());
    }
    /**
     * Show the new post form
     */
    public function create()
    {
        $data = $this->dispatch(new PostFromFields());
        return view('admin.post.create', $data);
    }
    /**
     * Store a newly created Post
     *
     * @param PostCreateRequest $request
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFillData());
        $post->syncGrades($request->get('grades', []));
//        $post->syncFolder($request->get('new_folder'));
        return redirect()
            ->route('admin.post.index')
            ->withSuccess('新的文章创建成功.');
    }

    /**
     * Show the post edit form
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->dispatch(new PostFromFields($id));

        return view('admin.post.edit', $data);
    }

    /**
     * Update the Post
     *
     * @param PostUpdateRequest $request
     * @param int $id
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->syncGrades($request->get('grades', []));

        if ($request->action === 'continue') {
            return redirect()
                ->back()
                ->withSuccess('文章以保存');
        }

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('文章已保存');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->grades()->detach();
        $post->delete();

        return redirect()
            ->route('admin.post.index')
            ->withSuccess('文章已删除');
    }
}