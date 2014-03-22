<?php namespace Gzero\Repositories\Content;

use Gzero\EloquentBaseModel\Model\Collection;
use Gzero\Models\Content\Content;
use Gzero\Models\Lang;
use Gzero\Repositories\Interfaces\BaseRepository;
use Gzero\Repositories\Interfaces\TreeRepository;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface ContentRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
interface ContentRepository extends BaseRepository, TreeRepository {

    /**
     * Gets content by url
     *
     * @param String $url
     * @param Lang   $lang Lang object
     *
     * @return mixed
     */
    public function getByUrl($url, Lang $lang);

    /**
     * Get all root categories
     *
     * @return mixed
     */
    public function getRoots();

    /**
     * Returns contents by tag
     *
     * @param int   $id
     * @param int   $page
     * @param array $order
     *
     * @return Collection
     */
    public function getByTag($id, $page = 1, Array $order = []);

    /**
     * Only public content
     *
     * @return $this
     */
    public function onlyPublic();

    /**
     * Lazy load thumb
     *
     * @param Content|Collection $content Content model
     *
     * @return mixed
     */
    public function loadThumb($content);

}
