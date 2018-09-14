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
        if ($this->request->isPost()) {
            $month = $this->request->getPost('month');
            $year = $this->request->getPost('year');
        } else {
            $month = $this->getCurrentMonth();
            $year = $this->getCurrentYear();
        }
        $users_model = new  Users();

        $work_model = new  Works();

        $hours_to_work = 8;

        $auth = $this->getAuth();

        $id = $auth['id'];

        $firstUser = $users_model->getUsers($id);

        $works = $users_model->getWorks();

        $works_for_stop = $work_model->getStop();

        $myTimes = $work_model->myTimes($id);

        $times = $work_model->times($id);

        $the_calendar = $work_model->getAllDaysInMonth($month, $year);

        $assigned = $work_model->getAssigned($month, $year) * $hours_to_work;

        $total_work_time = $work_model->getUserWorkTime($id, $month, $year);

        $this->view->setVars(
            array(
                'users' => $firstUser,
                'works' => $works,
                'days' => $the_calendar,
                'stops' => $works_for_stop,
                'myTimes' => $myTimes,
                'times' => $times,
                'assigned' => $assigned,
                'total_work_time' => $total_work_time,
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