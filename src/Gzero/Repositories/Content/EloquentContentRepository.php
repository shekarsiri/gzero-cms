<?php namespace Gzero\Repositories\Content;

use Gzero\Models\Content\Content;
use Gzero\Models\Lang;
use Gzero\Models\Upload\UploadType;
use Gzero\Repositories\AbstractRepository;
use Gzero\Repositories\TreeRepositoryTrait;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentContentRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentContentRepository extends AbstractRepository implements ContentRepository {

    use TreeRepositoryTrait;

    protected $eagerLoad = ['type'];

    public function __construct(Content $content)
    {
        $this->model = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getByUrl($url, Lang $lang)
    {
        return $this->model->newQuery()
            ->whereHas(
                'translations',
                function ($q) use ($url, $lang) {
                    $q->where('url', '=', $url);
                    $q->onlyActive($lang);
                }
            )
            ->with($this->eagerLoad)
            ->first();
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------


    /**
     * {@inheritdoc}
     */
    public function listByTag($tag, Lang $lang)
    {
        return $this->model->newQuery()
            ->whereHas(
                'tags',
                function ($q) use ($tag, $lang) {
                    $q->join('tag_translations', 'content_tag.tag_id', '=', 'tag_translations.tag_id');
                    $q->where('name', '=', $tag);
                    $q->where('lang_id', '=', $lang->id);
                }
            )
            ->with($this->eagerLoad)
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function onlyPublic()
    {
        $this->getBuilder()->whereIsActive(1);
        return $this;
    }

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------

    //-----------------------------------------------------------------------------------------------
    // START: Lazy loading section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function loadThumb($content)
    {
        return $content->load('thumb');
    }

    /**
     * {@inheritdoc}
     */
    public function loadUploads($content, Lang $lang, UploadType $type = NULL)
    {
        return $content->load(
            array(
                'uploads' => function ($query) use ($type, $lang) {
                        $query->withActiveTranslation($lang);
                        if (!empty($type)) {
                            $query->whereTypeId($type->id);
                        }
                    }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadTranslations($content, Lang $lang = NULL)
    {
        return $content->load(
            array(
                'translations' => function ($query) use ($lang) {
                        $query->onlyActive($lang);
                    }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadTags($content, Lang $lang)
    {
        return $content->load(
            array(
                'tags' => function ($query) use ($lang) {
                        $query->withActiveTranslation($lang);
                    }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadMenuLink($content, Lang $lang)
    {
        return $content->load(
            array(
                'menuLink' => function ($query) use ($lang) {
                        $query->withActiveTranslation($lang);
                    }
            )
        );
    }

    //-----------------------------------------------------------------------------------------------
    // END: Lazy loading section
    //-----------------------------------------------------------------------------------------------

    public function create(array $input)
    {
        // TODO: Implement create() method.
    }

    public function update(array $input)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}
