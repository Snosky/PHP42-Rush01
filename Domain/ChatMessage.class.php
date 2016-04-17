<?php
namespace Domain;

class ChatMessage implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $content;

    /**
     * @var User
     */
    private $user;

    /**
     * @var integer
     */
    private $chat_id;

    /**
     * @var
     */
    private $date;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getChatId()
    {
        return $this->chat_id;
    }

    /**
     * @param int $chat_id
     */
    public function setChatId($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = htmlentities($content);
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return new \DateTime($this->date);
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function jsonSerialize()
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['user'] = $this->getUser();
        $data['content'] = $this->getContent();
        $data['date'] = $this->getDate();
        return $data;
    }
}