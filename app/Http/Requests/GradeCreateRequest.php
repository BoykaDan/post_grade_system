<?php

namespace App\Http\Requests;


class GradeCreateRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grade' => 'required|unique:grades,grade',
            'title' => 'required',
            'subtitle' => 'required',
            'layout' => 'required',
        ];
    }
    public function gradeFillData()
    {

        return [
            'grade'=>$this->grade,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'page_image' => $this->page_image,
            'meta_description' => $this->meta_description,
            'layout' => $this->layout,
            'reverse_direction' => 0,


        ];
        echo $this->layout;
    }
}