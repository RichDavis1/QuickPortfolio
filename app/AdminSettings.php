<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    /**
     * Validation rules.
     *
     * @var mixed[]
     */
    public static $rules = [
        'field' => ['required', 'string', 'max:100'],
        'value' => ['sometimes', 'string', 'max:100', 'nullable']
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'field', 'value'
    ];

    /**
     * All admin setting fields and values.
     *
     * @var object|null
     */
    protected ?object $settings = null;

    /**
     * Field is route primary key
     *
     * @return string
     */
    public function getRouteKeyName() : string
    {
        return 'field';
    }

    /**
     * Return website name.
     *
     * @return string
     */
    public function getWebsiteName() : string
    {
        $websiteName = $this->getField('website_name');

        return (is_string($websiteName)) ? $websiteName : 'Add your website name';
    }

    /**
     * Return github link.
     *
     * @return string|null
     */
    public function getGithubLink() : ?string
    {
        $githubLink = $this->getField('github_link');

        return (is_string($githubLink)) ? $githubLink : null;
    }

    /**
     * Return linkedin link.
     *
     * @return string|null
     */
    public function getLinkedinLink() : ?string
    {
        $linkedinLink = $this->getField('linkedin_link');

        return (is_string($linkedinLink)) ? $linkedinLink : null;
    }

    /**
     * Return formatted settings by key->value.
     *
     * @return object|null
     */
    protected function getSettings() : ?object
    {
        return $this->settings ?? $this->fetchSettings();
    }

    /**
     * Return specified field from admin settings if exists.
     *
     * @param string $field
     * @return string|null
     */
    protected function getField(string $field) : ?string
    {
        $settings = $this->getSettings();

        if (!is_object($settings)) {
            return null;
        }

        return !empty($settings[$field]) ? $settings[$field] : null;
    }

    /**
     * Find and set value->field pairs for admin settings.
     *
     * @return object|null
     */
    private function fetchSettings() : ?object
    {
        $settings = $this->pluck('value', 'field');

        return $this->settings = $settings;
    }
}
