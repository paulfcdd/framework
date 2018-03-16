<?php


namespace Entity;

/**
 * @Entity()
 * @Table(name="posts")
 */
class Post
{
    /** @var int
     * @Id()
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Column()
     */
    private $title;

    /**
     * @var string
     * @Column(type="text", length=500)
     */
    private $content;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Post
     */
    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string $content): Post
    {
        $this->content = $content;
        return $this;
    }


}