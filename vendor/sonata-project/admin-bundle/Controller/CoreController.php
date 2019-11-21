<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\AdminBundle\Controller;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Search\SearchHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\TbMovimentacaoDespesaOs as Os;



/**
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class CoreController extends Controller
{
    /**
     * @return Response
     */
    public function dashboardAction()
	
    {
		
		$chDpg = $this->getChDpg();
		
		$chDfa = $this->getChDfa();
		
		$chDop = $this->getChDop();
		
		$chCenipa = $this->getChCenipa();
		
		$solicitacoesSeripa1 = $this->getOrdenadorSeripa1();
		
		$solicitacoesSeripa2 = $this->getOrdenadorSeripa2();

		$solicitacoesSeripa3 = $this->getOrdenadorSeripa3();

		$solicitacoesSeripa4 = $this->getOrdenadorSeripa4();

		$solicitacoesSeripa5 = $this->getOrdenadorSeripa5();
		
		$solicitacoesSeripa6 = $this->getOrdenadorSeripa6();

		$solicitacoesSeripa7 = $this->getOrdenadorSeripa7();
		
		$cxChseripa1 = $this->getChSeripa1();
		
		$cxChseripa2 = $this->getChSeripa2();

		$cxChseripa3 = $this->getChSeripa3();

		$cxChseripa4 = $this->getChSeripa4();

		$cxChseripa5 = $this->getChSeripa5();

		$cxChseripa6 = $this->getChSeripa6();

		$cxChseripa7 = $this->getChSeripa7();
		
		$cxSeripa1 = $this->getCxSeripa1();

		$cxSeripa2 = $this->getCxSeripa2();	

		$cxSeripa3 = $this->getCxSeripa3();
		
		$cxSeripa4 = $this->getCxSeripa4();
		
		$cxSeripa5 = $this->getCxSeripa5();
		
		$cxSeripa6 = $this->getCxSeripa6();
		
		$cxSeripa7 = $this->getCxSeripa7();

		$osAutorizadaCenipa = $this->getOsAutorizadaCenipa();
		
		$osAutorizadaSeripa1 = $this->getOsAutorizadaSeripa1();
		
		$osAutorizadaSeripa2 = $this->getOsAutorizadaSeripa2();

		$osAutorizadaSeripa3 = $this->getOsAutorizadaSeripa3();

		$osAutorizadaSeripa4 = $this->getOsAutorizadaSeripa4();
		
		$osAutorizadaSeripa5 = $this->getOsAutorizadaSeripa5();
		
		$osAutorizadaSeripa6 = $this->getOsAutorizadaSeripa6();
		
		$osAutorizadaSeripa7 = $this->getOsAutorizadaSeripa7();
		
		$acompanhamentoSeripa1 = $this->getAcompanhamentoSeripa1();
		
		$acompanhamentoSeripa2 = $this->getAcompanhamentoSeripa2();
		$acompanhamentoSeripa3 = $this->getAcompanhamentoSeripa3();
		$acompanhamentoSeripa4 = $this->getAcompanhamentoSeripa4();
		$acompanhamentoSeripa5 = $this->getAcompanhamentoSeripa5();
		
		$acompanhamentoSeripa6 = $this->getAcompanhamentoSeripa6();
		
		$acompanhamentoSeripa7 = $this->getAcompanhamentoSeripa7();

		$arrayNaturezaDespesa[] = array(

			1 => '3390.14 - DIÁRIA CIVIL',
			2 => '3390.15 - DIÁRIA MILITAR',
			3 => '3390.33 - PASSAGEM AÉREA'
		);

		$arrayMissao[] = array(

			1 => 'INVESTIGAÇÃO',
			2 => 'PREVEÇÃO',
			3 => 'ADMINISTRATIVO',
			4 => 'CAPACITAÇÃO',
			5 => 'OPERACIONAL - TRIPULANTE',
			6 => 'REPRESENTAÇÃO',
			7 => 'OUTROS'

		);

		$arrayUnidade[] = array(

			1 => 'CENIPA',
			2 => 'SERIPA1',
			3 => 'SERIPA2',
			4 => 'SERIPA3',
			5 => 'SERIPA4',
			6 => 'SERIPA5',
			7 => 'SERIPA6',
			8 => 'SERIPA7'

		);
		
		
		$arrayStatusPassagem[] = array(
			0 => 'NÃO EMITIR PASSAGEM',
			1 => 'SOLICITAR EMISSÃO',
			2 => 'APROVADA PELO CHEFE DO SETOR/SERIPA',
			3 => 'AUTORIZADA PELO VCH',
			4 => 'NÃO AUTORIZADA PELO VCH',
			5 => 'CANCELAR PASSAGEM',
			6 => 'PASSAGEM EM EMISSÃO',
			7 => 'PASSAGEM EMITIDA',
			

		);
		

		
		//$despesaNatureza = $despesa->getValorDespesa();
		
		
		
        $blocks = array(
            'top' => array(),
            'left' => array(),
            'center' => array(),
            'right' => array(),
            'bottom' => array(),
        );

        foreach ($this->container->getParameter('sonata.admin.configuration.dashboard_blocks') as $block) {
            $blocks[$block['position']][] = $block;
        }

        $parameters = array(
            'base_template' => $this->getBaseTemplate(),
            'admin_pool' => $this->container->get('sonata.admin.pool'),
            'blocks' => $blocks,
			'dpg'			  => $chDpg,
			'dop'			  => $chDop,
			'dfa'			  => $chDfa,
			'chcenipa'			  => $chCenipa,
			'seripa1' => $solicitacoesSeripa1,
			'seripa2' => $solicitacoesSeripa2,
			'seripa3' => $solicitacoesSeripa3,
			'seripa4' => $solicitacoesSeripa4,
			'seripa5' => $solicitacoesSeripa5,
			'seripa6' => $solicitacoesSeripa6,
			'seripa7' => $solicitacoesSeripa7,
			'osAutCenipa' => $osAutorizadaCenipa,
			'osAutSeripa1' => $osAutorizadaSeripa1,
			'osAutSeripa2' => $osAutorizadaSeripa2,
			'osAutSeripa3' => $osAutorizadaSeripa3,
			'osAutSeripa4' => $osAutorizadaSeripa4,
			'osAutSeripa5' => $osAutorizadaSeripa5,
			'osAutSeripa6' => $osAutorizadaSeripa6,
			'osAutSeripa7' => $osAutorizadaSeripa7,
			'caixaSeripa1' => $cxSeripa1,
			'caixaSeripa2' => $cxSeripa2,
			'caixaSeripa3' => $cxSeripa3,
			'caixaSeripa4' => $cxSeripa4,
			'caixaSeripa5' => $cxSeripa5,
			'caixaSeripa6' => $cxSeripa6,
			'caixaSeripa7' => $cxSeripa7,
			'chSeripa1' => $cxChseripa1,
			'chSeripa2' => $cxChseripa2,
			'chSeripa3' => $cxChseripa3,
			'chSeripa4' => $cxChseripa4,
			'chSeripa5' => $cxChseripa5,
			'chSeripa6' => $cxChseripa6,
			'chSeripa7' => $cxChseripa7,
			'acompanhamentoSeripa1' => $acompanhamentoSeripa1,
			'acompanhamentoSeripa2' => $acompanhamentoSeripa2,
			'acompanhamentoSeripa3' => $acompanhamentoSeripa3,
			'acompanhamentoSeripa4' => $acompanhamentoSeripa4,
			'acompanhamentoSeripa5' => $acompanhamentoSeripa5,
			'acompanhamentoSeripa6' => $acompanhamentoSeripa6,
			'acompanhamentoSeripa7' => $acompanhamentoSeripa7,
			
			
			
			
        );

        if (!$this->getCurrentRequest()->isXmlHttpRequest()) {
            $parameters['breadcrumbs_builder'] = $this->get('sonata.admin.breadcrumbs_builder');
        }

        return $this->render($this->getAdminPool()->getTemplate('dashboard'), $parameters);
    }

    /**
     * The search action first render an empty page, if the query is set, then the template generates
     * some ajax request to retrieve results for each admin. The Ajax query returns a JSON response.
     *
     * @param Request $request
     *
     * @return JsonResponse|Response
     *
     * @throws \RuntimeException
     */
    public function searchAction(Request $request)
    {
        if ($request->get('admin') && $request->isXmlHttpRequest()) {
            try {
                $admin = $this->getAdminPool()->getAdminByAdminCode($request->get('admin'));
            } catch (ServiceNotFoundException $e) {
                throw new \RuntimeException('Unable to find the Admin instance', $e->getCode(), $e);
            }

            if (!$admin instanceof AdminInterface) {
                throw new \RuntimeException('The requested service is not an Admin instance');
            }

            $handler = $this->getSearchHandler();

            $results = array();

            if ($pager = $handler->search($admin, $request->get('q'), $request->get('page'), $request->get('offset'))) {
                foreach ($pager->getResults() as $result) {
                    $results[] = array(
                        'label' => $admin->toString($result),
                        'link' => $admin->generateObjectUrl('edit', $result),
                        'id' => $admin->id($result),
                    );
                }
            }

            $response = new JsonResponse(array(
                'results' => $results,
                'page' => $pager ? (int) $pager->getPage() : false,
                'total' => $pager ? (int) $pager->getNbResults() : false,
            ));
            $response->setPrivate();

            return $response;
        }

        return $this->render($this->container->get('sonata.admin.pool')->getTemplate('search'), array(
            'base_template' => $this->getBaseTemplate(),
            'breadcrumbs_builder' => $this->get('sonata.admin.breadcrumbs_builder'),
            'admin_pool' => $this->container->get('sonata.admin.pool'),
            'query' => $request->get('q'),
            'groups' => $this->getAdminPool()->getDashboardGroups(),
        ));
    }

    /**
     * Get the request object from the container.
     *
     * This method is compatible with both Symfony 2.3 and Symfony 3
     *
     * NEXT_MAJOR: remove this method.
     *
     * @deprecated since 3.0, to be removed in 4.0 and action methods will be adjusted.
     *             Use Symfony\Component\HttpFoundation\Request as an action argument.
     *
     * @return Request
     */
		
		
		

	 
		protected function getChDpg(){
			
					
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->innerJoin('o.setorId', 's');
			$qb->innerJoin('s.tbDivisao', 'd');
			$qb->innerJoin('d.unidade', 'u');
			
			$qb->where('u.id = :unidade');
			$qb->andWhere('d.id = :divisao');
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 1);
			$qb->setParameter('divisao', 1);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChDop(){
			
			
			/*
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('a');
			$qb->select('count(a)')->from('AppBundle:RcsvOcorrencia', 'a')->where('a.situacaoRcsv = :item')->setParameter('item', 'ENTRADA');
			return $qb->getQuery()->execute();
			*/
			
			
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->innerJoin('o.setorId', 's');
			$qb->innerJoin('s.tbDivisao', 'd');
			$qb->innerJoin('d.unidade', 'u');

			$qb->where('u.id = :unidade');
			$qb->andWhere('d.id = :divisao');
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 1);
			$qb->setParameter('divisao', 2);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChDfa(){
			
			
			/*
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('a');
			$qb->select('count(a)')->from('AppBundle:RcsvOcorrencia', 'a')->where('a.situacaoRcsv = :item')->setParameter('item', 'ENTRADA');
			return $qb->getQuery()->execute();
			*/
			
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->innerJoin('o.setorId', 's');
			$qb->innerJoin('s.tbDivisao', 'd');
			$qb->innerJoin('d.unidade', 'u');

			$qb->where('u.id = :unidade');
			$qb->andWhere('d.id = :divisao');
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 1);
			$qb->setParameter('divisao', 3);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChCenipa(){
			
			
			/*
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('a');
			$qb->select('count(a)')->from('AppBundle:RcsvOcorrencia', 'a')->where('a.situacaoRcsv = :item')->setParameter('item', 'ENTRADA');
			return $qb->getQuery()->execute();
			*/
			
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 1);
			$qb->setParameter('status', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa1(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 2);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa2(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 3);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa3(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 4);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa4(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 5);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa5(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 6);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa6(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 7);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOrdenadorSeripa7(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusPassagem = :status');
			$qb->setParameter('unidade', 8);
			$qb->setParameter('status', 2);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa1(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 2);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa2(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 3);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa3(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 4);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa4(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 5);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa5(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 6);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa6(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 7);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getChSeripa7(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status');
			$qb->setParameter('unidade', 8);
			$qb->setParameter('status', 'ANALISADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		
		
		
		
		protected function getCxSeripa1(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 2);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		
		protected function getCxSeripa2(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 3);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getCxSeripa3(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 4);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		
		
		protected function getCxSeripa4(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 5);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
	
		}
		
		protected function getCxSeripa5(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 6);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getCxSeripa6(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 7);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa1(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 2);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa2(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 3);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa3(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 4);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa4(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 5);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa5(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 6);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa6(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 7);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getAcompanhamentoSeripa7(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs != :status ');
			$qb->setParameter('unidade', 8);
			$qb->setParameter('status', 'PENDENTE');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getCxSeripa7(){
			
		
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			$qb->where('o.omPagadora = :unidade');			
			$qb->andWhere('o.statusOs = :status or o.statusOs = :status2');
			$qb->setParameter('unidade', 8);
			$qb->setParameter('status', 'PENDENTE');
			$qb->setParameter('status2', 'CONFIRMADA');
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}

		protected function getOsAutorizadaCenipa(){



		$em = $this->get('doctrine.orm.default_entity_manager');
		$qb = $em->createQueryBuilder('o');
		$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
		$qb->innerJoin('o.setorId', 's');
		$qb->innerJoin('s.tbDivisao', 'd');
		$qb->innerJoin('d.unidade', 'u');

		$qb->where('u.id = :unidade');
		$qb->andWhere('o.statusOs = :status');
		$qb->orWhere('o.statusOs = :status1');
		$qb->orWhere('o.statusOs = :status2');
		$qb->setParameter('unidade', 1);
		$qb->setParameter('status', 'AUTORIZADA');
		$qb->setParameter('status1', 'PROCESSADA');
		$qb->setParameter('status2', 'EM PROCESSAMENTO');



		return $count = $qb->getQuery()->getSingleScalarResult();


	}
		
		protected function getOsAutorizadaSeripa1(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 2);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);


			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOsAutorizadaSeripa2(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 3);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOsAutorizadaSeripa3(){
			
			
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 4);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);
			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOsAutorizadaSeripa4(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 5);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);
			

			return $count = $qb->getQuery()->getSingleScalarResult();

			
						
		
		}
		
		protected function getOsAutorizadaSeripa5(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 6);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOsAutorizadaSeripa6(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 7);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		protected function getOsAutorizadaSeripa7(){
			
			
				
			$em = $this->get('doctrine.orm.default_entity_manager');
			$qb = $em->createQueryBuilder('o');
			$qb->select('COUNT(o)')->from('AppBundle:TbOrdemServico', 'o');
			
			
			$qb->where('o.omPagadora = :unidade');
			$qb->andWhere('o.statusPassagem > :statusPassagem and o.statusPassagem < :statusEmitida');
			$qb->setParameter('unidade', 8);
			$qb->setParameter('statusPassagem', 1);
			$qb->setParameter('statusEmitida', 5);

			

			return $count = $qb->getQuery()->getSingleScalarResult();
						
		
		}
		
		
		
		
		
		
		

	 
    public function getRequest()
    {
        @trigger_error(
            'The '.__METHOD__.' method is deprecated since 3.0 and will be removed in 4.0.'.
            ' Inject the Symfony\Component\HttpFoundation\Request into the actions instead.',
            E_USER_DEPRECATED
        );

        return $this->getCurrentRequest();
    }

    /**
     * @return Pool
     */
    protected function getAdminPool()
    {
        return $this->container->get('sonata.admin.pool');
    }

    /**
     * @return SearchHandler
     */
    protected function getSearchHandler()
    {
        return $this->get('sonata.admin.search.handler');
    }

    /**
     * @return string
     */
    protected function getBaseTemplate()
    {
        if ($this->getCurrentRequest()->isXmlHttpRequest()) {
            return $this->getAdminPool()->getTemplate('ajax');
        }

        return $this->getAdminPool()->getTemplate('layout');
    }

    /**
     * Get the request object from the container.
     *
     * @return Request
     */
    private function getCurrentRequest()
    {
        // NEXT_MAJOR: simplify this when dropping sf < 2.4
        if ($this->container->has('request_stack')) {
            return $this->container->get('request_stack')->getCurrentRequest();
        }

        return $this->container->get('request');
    }
}
