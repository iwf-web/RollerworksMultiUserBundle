<?php

/*
 * This file is part of the RollerworksMultiUserBundle package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Bundle\MultiUserBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * RemoveParentServicesPass, marks the parent 'FOSUserBundle' services as abstract.
 *
 * By making them abstract they are removed and prevent any conflict or container bloat.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * @codeCoverageIgnore
 */
class RemoveParentServicesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $container->getDefinition('fos_user.listener.authentication')->setAbstract(false)->clearTags();
        $container->getDefinition('fos_user.listener.resetting')->setAbstract(false)->clearTags();

        // Forms
        $container->getDefinition('fos_user.registration.form.type')->setAbstract(false);
        $container->getDefinition('fos_user.resetting.form.type')->setAbstract(false);
        $container->getDefinition('fos_user.profile.form.type')->setAbstract(false);
        $container->getDefinition('fos_user.change_password.form.type')->setAbstract(false);
        $container->getDefinition('fos_user.group.form.type')->setAbstract(false);
    }
}
