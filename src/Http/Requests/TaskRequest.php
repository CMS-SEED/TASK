<?php

namespace Cms_Framework_Seed\Task\Http\Requests;

use App\Http\Requests\Request as FormRequest;
use Illuminate\Http\Request;
use Gate;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $task = $this->route('task');

        if (is_null($task)) {
            // Determine if the user is authorized to access task module,
            return $this->canAccess();
        }

        if ($request->isMethod('POST') || $request->is('*/create')) {
            // Determine if the user is authorized to create an entry,
            return $request->user('admin.web')->can('create', $task);
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->is('*/edit')) {
            // Determine if the user is authorized to update an entry,
            return $request->user('admin.web')->can('update', $task);
        }

        if ($request->isMethod('DELETE')) {
            // Determine if the user is authorized to delete an entry,
            return $request->user('admin.web')->can('delete', $task);
        }

        // Determine if the user is authorized to view the module.
        return $request->user('admin.web')->can('view', $task);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if ($request->isMethod('POST')) {
            // validation rule for create request.
            return [
                
            ];
        }

        if ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            // Validation rule for update request.
            return [
                
            ];
        }

        // Default validation rule.
        return [

        ];
    }
    /**
     * Check whether the user can access the module.
     *
     * @return bool
     **/
    protected function canAccess()
    {
        if ($this->formRequest->user()->isAdmin() || $this->formRequest->user()->isUser()) {
            return true;
        }

        return $this->formRequest->user()->canDo('calendar.calendar.view');
    }

}
