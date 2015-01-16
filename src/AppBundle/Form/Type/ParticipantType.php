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

/**
 * Class ParticipantType
 * 
 * @category SymfonyBundle
 * @package  AppBundle\Form\Type
 * @author   Jesús Flores <jesus.flores@bq.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GNU General Public License
 * @link     http://bq.com
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text')
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Participant',
            ));
    }

    public function getName()
    {
        return 'participant';
    }
}