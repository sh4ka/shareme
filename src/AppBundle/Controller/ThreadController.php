<?php
/*
 * This file is part of the Mundoreader Symfony Base package.
 *
 * (c) Mundo Reader S.L.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Submission;
use AppBundle\Entity\Thread;
use AppBundle\Form\Type\AddContentType;
use AppBundle\Form\Type\PhotoType;
use AppBundle\Upload\PhotoUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Util\SecureRandom;

/**
 * Class ThreadController
 * 
 * @category SymfonyBundle
 * @package  AppBundle\Controller
 * @author   Jesús Flores <jesus.flores@bq.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GNU General Public License
 * @link     http://bq.com
 */
class ThreadController extends Controller
{
    /**
     * @Route("/thread/{threadHash}", name="show_thread")
     */
    public function threadAction($threadHash)
    {
        $thread = $this->getDoctrine()->getRepository('AppBundle:Thread')->findOneBy(array('hash' => $threadHash));
        $addContentForm = $this->createForm(new AddContentType($thread), null, array());
        return $this->render(
            'thread/show.html.twig',
            array(
                'thread'  => $thread,
                'addContentForm' => $addContentForm->createView()
                )
        );
    }

    /**
     * @Route("/add-content", name="add_content_thread")
     */
    public function addContentToThreadAction(Request $request){
        $contentForm = $this->createForm(new AddContentType(), array());
        $thread = $this->getDoctrine()->getRepository('AppBundle:Thread')->findOneBy(array('hash' => $request->get('thread_hash')));
         if($thread && $request->isMethod('POST')){
            // get new content to be added to thread
            $contentForm->submit($request);
            if ($contentForm->isValid()) {
                $contentData = $contentForm->getData();
                $filehash = hash_file('sha1', $_FILES['add_content']['tmp_name']['photo']);
                $content = $this->getDoctrine()->getRepository('AppBundle:Content')->findOneBy(array('hash' => $filehash));
                if($content == null){
                    $url = $this->getPhotoUploader()->upload($contentData['photo']);
                    $content = new Content();
                    $content->setUrl($url);
                    $content->setHash($filehash);
                }
                if($content->getUrl()){
                    $submission = new Submission();
                    $submission->setContent($content);
                    $submission->setThread($thread);
                    $submission->setDateAdded(new \DateTime());
                    $thread->addSubmission($submission);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($thread);
                    $em->persist($content);
                    $em->persist($submission);
                    $em->flush();
                    return $this->redirect('/thread/'.$thread->getHash());
                }
            }
        }
        return $this->redirect('/thread/'.$thread->getHash());
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        $contentForm = $this->createForm(new PhotoType(), array());
        $url = '';
        if ($request->isMethod('POST')) {
            $contentForm->submit($request);
            if ($contentForm->isValid()) {
                $contentData = $contentForm->getData();
                // find if content has been uploaded before
                $filehash = hash_file('sha1', $_FILES['photo']['tmp_name']['photo']);
                $content = $this->getDoctrine()->getRepository('AppBundle:Content')->findOneBy(array('hash' => $filehash));
                if($content == null){
                    $url = $this->getPhotoUploader()->upload($contentData['photo']);
                    $content = new Content();
                    $content->setUrl($url);
                    $content->setHash($filehash);
                }
                if($content->getUrl()){
                    $generator = new SecureRandom();
                    $hash = sha1($generator->nextBytes(160));
                    // create the thread
                    $thread = new Thread();
                    $thread->setHash($hash);
                    $thread->setTitle($contentData['title']);
                    $thread->setCreatedAt(new \DateTime());
                    // find if participant exists
                    $em = $this->getDoctrine()->getManager();
                    $participant = $this->getDoctrine()->getRepository('AppBundle:Participant')->findOneBy(array('email' => $contentData['creator']));
                    if($participant == null){
                        $participant = new Participant();
                        $participant->setEmail($contentData['creator']);
                    }
                    $thread->addParticipant($participant);
                    $thread->setCreatedBy($participant);

                    $submission = new Submission();
                    $submission->setContent($content);
                    $submission->setThread($thread);
                    $submission->setDateAdded(new \DateTime());
                    $thread->addSubmission($submission);
                    $content->addSubmission($submission);

                    $em->persist($thread);
                    $em->persist($content);
                    $em->persist($submission);
                    $em->flush();

                    return $this->redirect('/thread/'.$hash);
                }
            }
        }

        return $this->render(
            'thread/create.html.twig',
            array(
                'contentForm'  => $contentForm->createView(),
                'url' => $url
            )
        );
    }

    /**
     * @return PhotoUploader
     */
    protected function getPhotoUploader()
    {
        return $this->get('shareme_storage.photo_uploader');
    }
} 