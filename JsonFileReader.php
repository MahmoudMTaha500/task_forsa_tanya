<?php

class JsonFileReader implements FileReaderInterface
{

    public function __construct(public readonly $filename)
    {
    }

    public function readItems(): array
    {
        $items = [];
        $data = $this->getData();
        return $this->pushFileDataIntoItemsArray($items, $data);
    }


    public function getData(): array
    {
        $data = file_get_contents($this->filename);
        return json_decode($data);
    }

    public function pushFileDataIntoItemsArray(array $items, $data): array
    {
        foreach ($data as $element) {
            $item = new Item();
            $item->id = $element->_id;
            $item->name = $element->item_name;
            $items[] = $item;
        }

        return $items;
    }
}
