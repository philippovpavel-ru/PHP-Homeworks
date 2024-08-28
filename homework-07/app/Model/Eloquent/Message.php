<?php

namespace App\Model\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = [
        'text',
        'created_at',
        'author_id',
        'image',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public static function deleteMessage(int $messageId)
    {
        return self::destroy($messageId);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::with('author')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public static function getUserMessages(int $userId, int $limit)
    {
        return self::query()->where('author_id', '=', $userId)->limit($limit)->get();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->authorId,
            'text' => $this->text,
            'created_at' => $this->createdAt,
            'image' => $this->image
        ];
    }
}
