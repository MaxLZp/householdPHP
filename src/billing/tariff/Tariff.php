<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\billing\PriceableInterface;
use maxlzp\household\entity\Entity;

/**
 * Class Tariff
 * @package maxlzp\household\billing\tariff
 */
abstract class Tariff extends Entity implements PriceableInterface
{
    use ParentTrait;
    use TariffTitleTrait;
}