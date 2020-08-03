<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Project extends Model
{
    /**
     * Color assortment for card backgrounds.
     *
     * @var mixed[]
     */
    protected const COLORS = [
        ['background' => '#0ded97',
        'text' => '#252c34'],
        ['background' => '#1458eb',
        'text' => '#ededed'],
        ['background' => '#cb1a36',
        'text' => '#ededed'],
        ['background' => '#f6774c',
        'text' => '#252c34'],
        ['background' => '#19b2fe',
        'text' => '#252c34'],
        ['background' => '#c4166d',
        'text' => '#ededed'],
        ['background' => '#febf10',
        'text' => '#252c34']
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'status', 'content', 'categories', 'github_link', 'read_time', 'slug'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var mixed[]
     */
    protected $casts = [
        'categories' => 'array',
    ];

    /**
     * Set colors for project.
     *
     * @var mixed[]
     */
    protected array $colors;

    /**
     * Return random background color.
     *
     * @return string
     */
    public function getBackgroundColor() : string
    {
        $colors = $this->getColors();

        return $colors['background'];
    }

    /**
     * Return random color.
     *
     * @return string
     */
    public function getRandomColor() : string
    {
        $colors = $this->fetchColors();

        return $colors['background'];
    }

    /**
     * Return random text color.
     *
     * @return string
     */
    public function getTextColor() : string
    {
        $colors = $this->getColors();

        return $colors['text'];
    }

    /**
     * Validation rules.
     *
     * @return array
     */
    public function rules() : array
    {
        $rules = [
            'status' => ['sometimes', 'in:draft,published', 'string', 'max:255'],
            'content' => ['sometimes', 'string', 'max:5000', 'nullable'],
            'categories' => ['sometimes', 'array', 'max:200', 'nullable'],
            'github_link' => ['sometimes', 'string', 'max:100', 'nullable'],
            'read_time' => ['sometimes', 'integer', 'max:100', 'nullable'],
            'slug' => ['slug', 'string', 'max:200', 'unique:projects']
        ];

        $projectId = !empty($this->getAttribute('id')) ? $this->getAttribute('id') : null;

        if (is_numeric($projectId)) {
            $rules['title'] = ['required', 'string', 'max:100', Rule::unique('projects')->ignore($projectId)];
        } else {
            $rules['title'] = ['required', 'string', 'max:100', 'unique:projects'];
        }

        return $rules;
    }

    /**
     * Return an array of labels for all selected categories of the project.
     *
     * @return array|null
     */
    public function categories() : ?array
    {
        if (!$this->getAttribute('id')) {
            return null;
        }

        $selectedCategories = DB::table('categories')->select('categories.label')
        ->join('category_assignment', 'categories.id', '=', 'category_assignment.category_id')
        ->where('category_assignment.post_id', $this->attributes['id'])->get()->toArray();

        return is_array($selectedCategories) ? $selectedCategories : null;
    }

    /**
     * Return an array of all categories and mark the selected categories for this project.
     *
     * @return array|null
     */
    public function mergedCategories() : ?array
    {
        $categories = DB::table('categories')->get()->toArray();

        if (!is_array($categories)) {
            return null;
        }

        if (!$this->getAttribute('id')) {
            return $categories;
        }

        $selectedCategories = CategoryAssignment::where('post_id', $this->getAttribute('id'))->get()->pluck('category_id')->toArray();

        if (!is_array($selectedCategories)) {
            return $categories;
        }

        foreach ($categories as $index => $category) {
            if (in_array($category->id, $selectedCategories)) {
                $categories[$index]->selected = 'active';
            }
        }

        return $categories;
    }

    /**
     * Update the stored category taxonomies for the project.
     *
     * @param Project $project
     * @param Request $request
     */
    public function updateCategories(Project $project, Request $request) : void
    {
        CategoryAssignment::where('post_id', $project->id)->delete();

        if (!is_array($request->categories)) {
            return;
        }

        $posts = [];
        foreach ($request->categories as $categoryId) {
            $posts[] = [
                'category_id' => $categoryId,
                'post_id' => $project->id,
                'table' => $project->getTable()
            ];
        }

        CategoryAssignment::insert($posts);
    }

    /**
     * Return random color selection.
     *
     * @return array
     */
    protected function getColors() : array
    {
        return $this->colors ?? $this->fetchColors();
    }

    /**
     * Set & return random color selection.
     *
     * @return mixed[]
     */
    private function fetchColors() : array
    {
        return $this->colors = self::COLORS[array_rand(self::COLORS)];
    }
}
