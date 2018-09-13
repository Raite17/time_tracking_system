<?php

class IndexController extends ControllerBase
{


    public function initialize()
    {
        $this->tag->setTitle('Main');
        parent::initialize();
    }

    public function indexAction()
    {
        $users_model = new  Users();

        $work_model = new  Works();

        $auth = $this->getAuth();

        $id = $auth['id'];

        $month = $this->getCurrentMonth();

        $year = $this->getCurrentYear();

        $firstUser = $users_model->getUsers($id);

        $works = $users_model->getWorks();

        $works_for_stop = $work_model->getStop();

        $myTimes = $work_model->myTimes($id);

        $times = $work_model->times($id);

        $the_calendar = $work_model->getAllDaysInMonth($month, $year);

        $assigned = $work_model->getAssigned($month, $year) * 8;

        $this->view->setVars(
            array(
                'users' => $firstUser,
                'works' => $works,
                'days' => $the_calendar,
                'stops' => $works_for_stop,
                'myTimes' => $myTimes,
                'times' => $times,
                'assigned' => $assigned,
            )
        );
    }

    public function startAction()
    {

        $work = new Works();

        if ($this->request->isPost()) {
            $user_id = $this->request->getPost('user_id', "int");
            $work->setStart();
        }
    }

    public function stopAction()
    {

        $work_model = new  Works();

        if ($this->request->isPost()) {
            $id_time = $this->request->getPost('id_time', "int");
            $works = $work_model->findStopColumn($id_time);
            $start = new DateTime($works->start);
            $currentDate = new DateTime('now');
            $difference = $currentDate->getTimestamp() - $start->getTimestamp();
            $works->total = $difference;
            $works->setStop();
        }
    }
}