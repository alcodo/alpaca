<?php

namespace Alpaca\Crud\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;

trait ControllerTrait
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = $this->getPermissionClass();
        $permission->canIndexOrFail();

        $entries = $this->getAllEntries();

        // set url's in models
        $parameters = func_get_args();
        $urlBuilder = $this->getUrlBuilderClass($parameters);
        $urlBuilder->setCollectionUrlReadUpdateDelete($entries);

        return view($this->getViewIndex(), [
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
            'entries'     => $entries,
            'columns'     => $this->getIndexColumns(),
            'create'      => [
                'url'  => $urlBuilder->getUrlCreate(),
                'text' => $this->getUrlCreateText(),
            ],
            'permissions' => $permission->getAllPermissions(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getPermissionClass()->canCreateOrFail();

        $parameters = func_get_args();
        $urlBuilder = $this->getUrlBuilderClass($parameters);

        /** @var HorizontalFormBuilder $form */
        $form = app('bootform.horizontal');
        $form->setColumnSizes($this->getColumnSizes());

        /** @var FormOpen $formStart */
        $formStart = $form->open();
        $formStart->action($urlBuilder->getUrlStore());

        $formFields = $this->getForm($form, null, $parameters);

        /** @var FormBuilder $formClose */
        $formClose = $form->close();

        $title = $this->getUrlCreateText();

        return view($this->getViewCreate(), compact('title', 'formStart', 'formClose', 'formFields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $parameters = func_get_args();

        /** @var \Illuminate\Http\Request $request */
        $request = request();
        $this->validate($request, $this->getValidationCreate());

        $this->getPermissionClass()->canCreateOrFail();
        $entry = $this->createEntry($request->all());

        $this->getNotificationClass()->store($entry->wasRecentlyCreated);

        $urlBuilder = $this->getUrlBuilderClass($parameters);

        return redirect($urlBuilder->getUrlIndex());
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $parameters = func_get_args();
        $id = end($parameters);

        $this->getPermissionClass()->canShowOrFail();
        $entry = $this->getEntry($id);

        return view($this->getViewShow(), [
            'title' => $this->getSingularModelName(),
            'entry' => $entry,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $parameters = func_get_args();
        $id = end($parameters);

        $this->getPermissionClass()->canEditOrFail();
        $entry = $this->getEntry($id);

        $urlBuilder = $this->getUrlBuilderClass($parameters);

        /** @var HorizontalFormBuilder $form */
        $form = app('bootform.horizontal');
        $form->setColumnSizes($this->getColumnSizes());
        $form->bind($entry);

        /** @var FormOpen $formStart */
        $formStart = $form->open();
        $formStart->action($urlBuilder->getUrlUpdate($entry->getKey()));
        $formStart->put();

        $formFields = $this->getForm($form, $entry);

        /** @var FormBuilder $formClose */
        $formClose = $form->close();
        $title = $this->getUrlEditText();

        return view($this->getViewEdit(), compact('title', 'formStart', 'formClose', 'formFields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $parameters = func_get_args();
        $id = end($parameters);

        $request = request();
        $this->validate($request, $this->getValidationUpdate());

        $this->getPermissionClass()->canEditOrFail();
        $status = $this->updateEntry($id, $request->all());

        $this->getNotificationClass()->updated($status);

        $urlBuilder = $this->getUrlBuilderClass($parameters);

        return redirect($urlBuilder->getUrlIndex());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $parameters = func_get_args();
        $id = end($parameters);

        $this->getPermissionClass()->canDestroyOrFail();
        $status = $this->destroyEntry($id);

        $this->getNotificationClass()->destroy($status);

        $urlBuilder = $this->getUrlBuilderClass($parameters);

        return redirect($urlBuilder->getUrlIndex());
    }
}
