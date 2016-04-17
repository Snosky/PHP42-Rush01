<?php
namespace Model;

use Domain\ChatMessage;
use Domain\Game;

class ChatModel extends Model
{

    function findByGame ($chat_id)
    {
        if ($chat_id)
        {
            // A Edit, SELECT WHERE date >= Date d'arrive de l'user sur la page
            $sql = 'SELECT *
                    FROM t_chat_message
                    WHERE game_id=:game_id
                    ORDER BY msg_id DESC
                    LIMIT 100';
            $row = $this->getDb()->prepare($sql);
            $row->bindValue(':game_id', $chat_id, \PDO::PARAM_INT);
        }
        else
        {
            $sql = 'SELECT *
                    FROM t_chat_message
                    WHERE game_id IS NULL';
            $row = $this->getDb()->prepare($sql);
        }
        $row->execute();
        $data = $row->fetchAll();

        $return = array ();
        foreach ($data as $row)
            $return[$row['msg_id']] = $this->buildDomainObject($row);
        return $return;
    }


    function save (ChatMessage $msg)
    {
        $sql = 'INSERT INTO t_chat_message (msg_content, usr_id, game_id, msg_date) 
                VALUES (:msg_content, :usr_id, :game_id, NOW())';
        $row = $this->getDb()->prepare($sql);
        $row->bindValue(':msg_content', $msg->getContent(), \PDO::PARAM_STR);
        $row->bindValue(':usr_id', $msg->getUser()->getId(), \PDO::PARAM_INT);
        $row->bindValue(':game_id', $msg->getChatId(), \PDO::PARAM_INT);
        $row->execute();
        $id = $this->getDb()->lastInsertId();
        $msg->setId($id);
    }

    /**
     * Class ChatModel
     * @package Model
     * Create new PHP Object 'ChatMessage' from Database Entry
     */
    function buildDomainObject ($row)
    {
        $msg = new ChatMessage();
        $msg->setId($row['msg_id']);
        $msg->setContent($row['msg_content']);
        $usr = new UserModel();
        $usr = $usr->findById($row['usr_id']);
        $msg->setUser($usr);
        $msg->setChatId($row['game_id']);
        $msg->setDate($row['msg_date']);
        return $msg;
    }

}
