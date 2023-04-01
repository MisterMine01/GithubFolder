<?php

namespace PCJs\Components;

use PCJs\Core\ComponentType\EntryComponentInterface;
use PCJs\Core\Response;

/**
 * @Entry GithubFolder
 */
class GithubFolder implements EntryComponentInterface
{
    private $data;

    /**
     * @Entry __construct
     */
    public function __construct()
    {
        $this->data = json_decode(file_get_contents('data/data.json'), true);
    }

    /**
     * @Entry __save
     */
    private function save()
    {
        file_put_contents('data/data.json', json_encode($this->data));
    }

    /**
     * @Entry create_folder
     */
    public function create_folder(string $user_name, string $folder_name): Response
    {
        if (!isset($this->data[$user_name])) {
            $this->data[$user_name] = [];
        }
        $this->data[$user_name][$folder_name] = [];
        $this->save();
        return new Response("Folder created");
    }

    /**
     * @Entry delete_folder
     */
    public function delete_folder(string $user_name, string $folder_name): Response
    {
        if (isset($this->data[$user_name][$folder_name])) {
            unset($this->data[$user_name][$folder_name]);
            $this->save();
            return new Response("Folder deleted");
        }
        return new Response("Folder not found");
    }

    /**
     * @Entry get_folders
     */
    public function get_folders(string $user_name): Response
    {
        if (isset($this->data[$user_name])) {
            return new Response(json_encode($this->data[$user_name]));
        }
        return new Response("User not found");
    }
}