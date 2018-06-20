<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Property;
use AppBundle\Form\PropertyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PropertyController extends Controller
{
    public function listAction(Request $request)
    {
        $properties = $this->getDoctrine()->getRepository(Property::class)->findAll();

        return $this->render('@App/admin/property_list.html.twig', [
            'properties' => $properties,
            'notice' => $request->getSession()->getFlashBag()->get('notice'),
            'error' => $request->getSession()->getFlashBag()->get('error')
        ]);
    }
    public function addPropertyAction(Request $request)
    {
        $property = null;
        if($request->attributes->get('id')) {
            $property = $this->getDoctrine()->getRepository(Property::class)->find($request->attributes->get('id'));
        }
        $property = $property ? $property : new Property();

        $form = $this->createForm(PropertyType::class, $property);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $is_updating = $form->getData()->getId();
            $em = $this->getDoctrine()->getManager();
            $em->persist($property);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice' , array(
                'msg' => $is_updating ? 'Property details updated' : 'Added a new property'
            ));
            return $this->redirectToRoute('app_properties');
        }

        return $this->render('@App/admin/add_property.html.twig', [
            'form' => $form->createView()
        ]);
    }
    public function deletePropertyAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if($request->attributes->get('id')) {
            $property = $em->getRepository(Property::class)->find($request->attributes->get('id'));
            if($property) {
                $em->remove($property);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice' , array(
                    'msg' => 'Property deleted successfully'
                ));
            }
            else {
                $request->getSession()->getFlashBag()->add('error' , array(
                    'msg' => 'Property not available'
                ));
            }
            return $this->redirectToRoute('app_properties');
        }
    }
}
