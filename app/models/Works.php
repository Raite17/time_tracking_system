<?php

class Works extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $start;

    /**
     *
     * @var string
     */
    public $stop;

    /**
     *
     * @var string
     */
    public $total;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("time_tracking");
        $this->setSource("works");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'works';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Works[]|Works|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Works|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function setStart()
    {
        try {
            $this->start = date('Y-m-d H:i:s', time());
            $this->user_id = $this->getDI()->getRequest()->getPost('user_id');
        } catch (Exception $exception) {
            $this->getMessages($exception);
        }

        if (!$this->save()) {
            $this->getDI()->getFlash()->error('Что то явно не так!');
            $this->getDI()->getResponse()->redirect('/stuff');
        } else {
            $this->getDI()->getResponse()->redirect('/stuff');
        }
    }

    public function setStop()
    {
        try {
            $this->stop = date('Y-m-d H:i:s', time());

        } catch (Exception $exception) {
            $this->getMessages($exception);
        }

        if (!$this->save()) {
            $this->getDI()->getFlash()->error('Что то явно не так!');
            $this->getDI()->getResponse()->redirect('/stuff');
        } else {
            $this->getDI()->getResponse()->redirect('/stuff');
        }
    }

    public function getStop()
    {
        return Works::find()->toArray();
    }

    public function myTimes($id)
    {
        return Works::findFirst(
            [
                'user_id = :user_id: AND DATE(start) = DATE(start) ORDER BY id DESC',
                'bind' => ['user_id' => $id],
            ]
        );
    }

    public function times($id)
    {
        return Works::find(
            [
                'user_id <> :user_id: AND MONTH(start) = :month:',
                'bind' => ['user_id' => $id, 'month' => 9],
            ]
        );
    }

    public function findStopColumn($id_time)
    {
        return Works::findFirst(
            [
                'id = :id_time: AND stop is NULL',
                'bind' => ['id_time' => $id_time],
            ]
        );
    }

    public function getAllDaysInMonth($month, $year)
    {
        $result = [];
        $start = strtotime('01-'.$month.'-'.$year);
        $end = strtotime('+1 month', $start);

        for ($i = $start, $j = 0; $i < $end; $i += 86400, $j++) {
            $result[$j]['day'] = date('D', $i);
            $result[$j]['number'] = $day = date('d', $i);
            $result[$j]['start_day'] = strtotime($year.'-'.$month.'-'.$day);
            $result[$j]['end_day'] = strtotime($year.'-'.$month.'-'.$day.' 23:59:59');
        };

        return $result;
    }

    public function getAssigned($month, $year)
    {
        $result = 0;
        $weekend = ['Sat', 'Sun'];
        $start = strtotime('01-'.$month.'-'.$year);
        $end = strtotime('+1 month', $start);

        for ($i = $start, $j = 0; $i < $end; $i += 86400, $j++) {
            if (!(in_array(date('D', $i), $weekend))) {
                $result++;
            }
        };

        return $result;
    }

    public function getUserWorkTime($id, $month, $year)
    {
        $result = 0;

        $expression = $year.'-'.$month.'%';

        $works = Works::find(
            [
                'user_id = :user_id: AND start LIKE :expression:',
                'bind' => ['user_id' => $id, 'expression' => $expression],
            ]
        );

        foreach ($works as $work) {
            $result += (int)$work->total;
        }

        return $result;
    }
}
