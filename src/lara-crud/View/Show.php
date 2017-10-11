<?php
namespace LaraCrud\View;

/**
 * Tuhin Bepari <digitaldreams40@gmail.com>
 */
use DbReader\Table;
use LaraCrud\Helpers\TemplateManager;
use LaraCrud\View\Partial\Panel;

class Show extends Page
{
    /**
     * @var Panel
     */
    protected $panel;

    /**
     * Show constructor.
     * @param Table $table
     * @param string $name
     * @param string $type
     */
    public function __construct(Table $table, $name = '', $type = '')
    {
        $this->table = $table;
        $this->setFolderName();
        $this->type = $type;
        $this->name = !empty($name) ? $name : config('laracrud.view.page.show.name');
        $this->panel = new Panel($this->table);
        parent::__construct();
    }

    /**
     * @return string
     */
    function template()
    {
        return (new TemplateManager("view/{$this->version}/pages/show.html", [
            'table' => $this->table->name(),
            'layout' => config('laracrud.view.layout'),
            'folder' => $this->panel->getFolder(),
        ]))->get();
    }

    /**
     * @throws \Exception
     */
    public function save()
    {
        if (!$this->panel->isExists()) {
            $this->panel->save();
        }
        parent::save();
    }
}