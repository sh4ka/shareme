<?php
/*
 * This file is part of the Mundoreader Symfony Base package.
 *
 * (c) Mundo Reader S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AddContentType
 * 
 * @category SymfonyBundle
 * @package  AppBundle\Form\Type
 * @author   Jesús Flores <jesus.flores@bq.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GNU General Public License
 * @link     http://bq.com
 */
class AddContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo', 'file', array('label' => 'Photo', 'mapped' => 'false'))
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'add_content';
    }
}