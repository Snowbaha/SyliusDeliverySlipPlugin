<?php


declare(strict_types=1);

namespace Snowbaha\SyliusDeliverySlipPlugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('snowbaha_sylius_delivery_slip_plugin');
        $rootNode = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
