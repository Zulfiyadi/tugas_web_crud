<?php

namespace App\Libraries;

class Cart
{
    protected $sessionKey = 'cart';

    public function __construct()
    {
        $this->contents();
    }

    public function insert(array $item): array
    {
        $row = $this->normalizeItem($item);
        $rowid = $this->generateRowId($row);

        if (isset($this->contents()[$rowid])) {
            $this->items[$rowid]['qty'] += $row['qty'];
        } else {
            $this->items[$rowid] = $row;
        }

        $this->save();

        return [
            'rowid' => $rowid,
            'item'  => $this->items[$rowid],
        ];
    }

    public function update(string $rowid, array $data): bool
    {
        if (!isset($this->contents()[$rowid])) {
            return false;
        }

        if (isset($data['qty'])) {
            $this->items[$rowid]['qty'] = max(1, (int) $data['qty']);
        }

        if (isset($data['price'])) {
            $this->items[$rowid]['price'] = (float) $data['price'];
        }

        if (array_key_exists('name', $data)) {
            $this->items[$rowid]['name'] = $data['name'];
        }

        if (array_key_exists('options', $data)) {
            $this->items[$rowid]['options'] = $data['options'];
        }

        $this->save();

        return true;
    }

    public function total(): float
    {
        $total = 0.0;

        foreach ($this->contents() as $item) {
            $total += (float) $item['price'] * (int) $item['qty'];
        }

        return round($total, 2);
    }

    public function remove(string $rowid): bool
    {
        if (!isset($this->contents()[$rowid])) {
            return false;
        }

        unset($this->items[$rowid]);
        $this->save();

        return true;
    }

    public function destroy(): void
    {
        session()->remove($this->sessionKey);
        $this->items = [];
    }

    public function contents(): array
    {
        $this->items = session()->get($this->sessionKey) ?? [];

        return $this->items;
    }

    protected function save(): void
    {
        session()->set($this->sessionKey, $this->items);
    }

    protected function normalizeItem(array $item): array
    {
        $normalized = [
            'id'      => (string) ($item['id'] ?? ''),
            'qty'     => max(1, (int) ($item['qty'] ?? 1)),
            'price'   => (float) ($item['price'] ?? 0),
            'name'    => (string) ($item['name'] ?? ''),
            'options' => $item['options'] ?? [],
        ];

        if (isset($item['rowid'])) {
            $normalized['rowid'] = $item['rowid'];
        }

        return $normalized;
    }

    protected function generateRowId(array $item): string
    {
        $id = $item['id'] ?? '';
        $options = $item['options'] ?? [];
        $optionsString = is_array($options) ? json_encode($options) : (string) $options;

        return md5($id . ':' . $optionsString);
    }
}
