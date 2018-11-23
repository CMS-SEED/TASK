<?php

namespace Cms_Framework_Seed\Task\Repositories\Presenter;

use Cms_Framework_Seed\Repository\Presenter\FractalPresenter;

class TaskListPresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaskListTransformer();
    }
}