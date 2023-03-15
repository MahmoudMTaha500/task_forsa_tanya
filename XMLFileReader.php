<?php

class XMLFileReader implements FileReaderInterface
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


    public function getData()
    {
        $data = file_get_contents($this->filename);
        return new xmlRead($data);
    }

    public function pushFileDataIntoItemsArray(array $items, $data): array
    {
        foreach ($data->getElements() as $element) {
            $item = new Item();
            $item->id = $element->_id;
            $item->name = $element->item_name;
            $items[] = $item;
        }

        return $items;
    }
}
