<?php

namespace App\Http\Controllers\Admin;

use App\grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeCreateRequest;
use App\Http\Requests\GradeUpdateRequest;
use App\Jobs\GradeFromFields;
use DB;
class GradeController extends Controller
{
    protected $fields = [
        'grade' => '',
        'title' => '',
        'subtitle' => '',
        'meta_description' => '',
        'page_image' => '',
        'layout' => 'article_system.layouts.index',
        'reverse_direction' => 0,
        'father_grade'=>[],
    ];


    /**
     * Display a listing of the grades.
     */
    public function index()
    {
       $grades = Grade::all();
        return view('admin.grade.index')
            ->withGrades($grades);
    }

    /**
     * Show form for creating new grade
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['allGrades'] =   Grade::lists('grade')->all();
        return view('admin.grade.create', $data);
    }

    /**
     * Store the newly created grade in the database.
     *
     * @param gradeCreateRequest $request
     * @return Response
     */
    public function store(GradeCreateRequest $request)
    {



        $grade = Grade::create($request->gradeFillData());
        $grade->syncFatherGrades($request->get('father_grade', []));
        return redirect('/admin/grade')
            ->withSuccess("分级 '$grade->grade' 创建成功");
    }

    /**
     * Show the form for editing a grade
     *find resource
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

        $data = $this->dispatch(new GradeFromFields($id));

        return view('admin.grade.edit', $data);
    }
    /**
     * Update the grade in storage
     *
     * @param GradeUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(GradeUpdateRequest $request, $id)
    {
        $grade = grade::findOrFail($id);

        $grade->fill($request->gradeFillData());
        $grade->save();
        $grade->syncFatherGrades($request->get('father_grade',[]));



        return redirect("/admin/grade/$id/edit")
            ->withSuccess("修改已被保存");

    }
    /**
     * Delete the grade
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->father_grade()->detach();
        $grade->delete();

        return redirect('/admin/grade')
            ->withSuccess(" '$grade->grade' 分级已被删除");
    }


}