<?php namespace Gzero\Handlers\Block;

use Gzero\Models\Lang;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Standard
 *
 * @package    Gzero\BlockTypeHandlers
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class Basic implements BlockTypeHandler {

    private $block;

    /**
     * {@inheritdoc}
     */
    public function load($block, Lang $lang)
    {
        $this->block = $block;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return \View::make('blocks.basic', ['block' => $this->block])->render();
    }
} 
