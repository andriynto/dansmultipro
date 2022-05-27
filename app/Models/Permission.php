<?php namespace App\Models;

use Laratrust\Models\LaratrustPermission;
use Laratrust\Traits\LaratrustPermissionTrait;
use Kyslik\ColumnSortable\Sortable;
use Lorisleiva\LaravelSearchString\Concerns\SearchString;

class Permission extends LaratrustPermission
{
    use LaratrustPermissionTrait, SearchString, Sortable;

    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

   /**
     * Scope to get all rows filtered, sorted and paginated.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $sort
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCollect($query, $sort = 'id')
    {
        $request = request();

        $search = $request->get('search');
        $limit  = $request->get('limit', setting('default.list_limit', '20'));

        return $query->usingSearchString($search)->sortable($sort)->paginate($limit);
    }

    /**
     * Scope to only include by action.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $action
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAction($query, $action = 'read')
    {
        return $query->where('name', 'like', $action . '-%');
    }

    /**
     * Transform display name.
     *
     * @return string
     */
    public function getTitleAttribute()
    {
        $replaces = [
            'Create ' => '',
            'Read ' => '',
            'Update ' => '',
            'Delete ' => '',
            'Modules' => 'Apps',
        ];

        $title = str_replace(array_keys($replaces), array_values($replaces), $this->display_name);

        return $title;
    }
}
