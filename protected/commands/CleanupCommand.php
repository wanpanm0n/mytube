<?php

class CleanupCommand extends CConsoleCommand {

    private static function findInImsiTable($userSimNoArray) {
        if(!count($userSimNoArray)) {
            return;
        }
        $imsiUserList = array();
        $imsiUsers = Yii::app()->db->createCommand()
                        ->select('mobile_no')
                        ->from('tbl_imsi')
                        ->where(array('in', 'mobile_no', $userSimNoArray))
                        ->queryAll();

        if($imsiUsers) {
            foreach($imsiUsers as $k=>$v) {
                array_push($imsiUserList, $v['mobile_no']);
            }
        }
        return $imsiUserList;
    }

    public function run($args) {
        try{
            $batchSize =100;
            $totalRun = 0;
            $offset = 0;
            $total = Yii::app()->db->createCommand()
                        ->select('count(*) as totalSimUsers')
                        ->from('tbl_sim_users')
                        ->queryAll();
            if($total[0]['totalSimUsers'] <= 0) {
                exit();
            }
            $totalUsers = $total[0]['totalSimUsers'];
            $totalRun = ceil($totalUsers/$batchSize);
            $userSimNoArray = array();
            $deleteIdList = array();
            while($totalRun >= 1) {
                $users = Yii::app()->db->createCommand()
                        ->select('sim_no, id')
                        ->from('tbl_sim_users')
                        ->order('id asc')
                        ->offset($offset)
                        ->limit($batchSize)
                        ->queryAll();

                if(!$users) {
                    break;
                }
                foreach($users as $k => $v) {
                    array_push($userSimNoArray, $v['sim_no']);
                }
                $imsiUserList = self::findInImsiTable($userSimNoArray);
                foreach($users as $k => $v) {
                    if(!in_array($v['sim_no'], $imsiUserList)) {
                        array_push($deleteIdList, $v['id']);
                    }
                }
                $offset = $offset+$batchSize;
                $totalRun--;
            }
            if(count($deleteIdList) > 0) {
                static::deleteSimUsers($deleteIdList);
            }

        }
        catch(Exception $e) {
            exit();
        }
    }

    private static function deleteSimUsers($simUsers) {
        if(!count($simUsers)) {
            return;
        }
        while(count($simUsers) > 0) {
	    $deleteList = array_splice($simUsers, 0, 100);
            Yii::app()->db->createCommand("delete from tbl_package_transaction where sim_users_id in ('".implode("', '", $deleteList)."')")->execute();
            Yii::app()->db->createCommand("delete from tbl_transaction where sim_users_id in ('".implode("', '", $deleteList)."')")->execute();
            Yii::app()->db->createCommand("delete from tbl_sim_users where id in ('".implode("', '", $deleteList)."')")->execute();
        }
    }

}
