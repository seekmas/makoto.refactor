<?php


namespace Web\BackBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Web\BackBundle\Entity\History;
use Web\BackBundle\Form\HistoryType;

class HistoryController extends Controller
{
    public function indexAction(Request $request , $id = 0)
    {
        $em = $this->getManager();
        if($id == 0)
        {
            $history = new History();
        }else
        {
            $history = $this->get('history_entity')->find($id);
        }


        $form = $this->getForm($history , new HistoryType() , $request);
        if($form->isValid())
        {
            $em->persist($history);
            $em->flush();

            $this->flash('success' , 'A new event is created ! ');
            return $this->redirect('menu.history_list');
        }

        return $this->render('WebBackBundle:History:index/index.html.twig' ,
            [
                'form' => $form->createView() ,
            ]
        );
    }

    public function listAction()
    {
        $history = $this->get('history_entity')
                        ->createQueryBuilder('h')
                        ->select('h')
                        ->orderBy('h.year' , 'desc')
                        ->getQuery()
                        ->getResult();

        return $this->render('WebBackBundle:History:list/index.html.twig' , ['history' => $history]);
    }

    public function deleteAction($id)
    {
        $em = $this->getManager();
        $history = $this->get('history_entity')->find($id);

        $em->remove($history);
        $em->flush();

        $this->flash('success' , 'An event is removed from history line ! ');
        return $this->redirect('menu.history_list');
    }
}