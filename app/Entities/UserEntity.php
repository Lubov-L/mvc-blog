<?php

namespace MvcBlog\App\Entities;

class UserEntity
{
    private int $id;
    private string $name;
    private string $phone;
    private string $email;
    private string $password;

    public function __construct(array $data = null)
    {
        if (empty($data)) {
            $data = $_POST;
        }
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                continue;
            }

            $value = strip_tags($value);
            $value = htmlentities($value, ENT_QUOTES, "UTF-8");

            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}