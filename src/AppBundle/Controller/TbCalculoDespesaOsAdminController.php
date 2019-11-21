<?php

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

use AppBundle\Entity\TbCalculoDespesaOs as Calculo;
use AppBundle\Entity\TbMovimentacaoDespesaPassagem as MovimentacaoPassagem;

use AppBundle\Entity\TbNaturezaDespesa as Despesa;

use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\Response;


class TbCalculoDespesaOsAdminController extends Controller
{
	
	
	public function listAction()
    {
		$movimentacaoDespesa = array();
		
		for($unidade =1; $unidade < 9; $unidade++){
			
			
			for($despesa =1; $despesa< 3; $despesa++){
				
				
				
				for($missao =1; $missao< 8; $missao++){
				
					
					$movimentacaoDespesa[$unidade][$despesa][$missao] = $this->obterCalculo($unidade, $despesa, $missao);
				
				}
				
			}
			
		}
		
		$anoExercicio = 2018;
		
		$arrayCenipaCivil[] =  array(
		
				'investigacao' => $movimentacaoDespesa[1][1][1][0]->getTotalDepesaMissao(),
				'prevencao' => $movimentacaoDespesa[1][1][2][0]->getTotalDepesaMissao(),
				'administrativo' => $movimentacaoDespesa[1][1][3][0]->getTotalDepesaMissao(),
				'capacitacao' => $movimentacaoDespesa[1][1][4][0]->getTotalDepesaMissao(),
				'operacional' => $movimentacaoDespesa[1][1][5][0]->getTotalDepesaMissao(),
				'representacao' => $movimentacaoDespesa[1][1][6][0]->getTotalDepesaMissao(),
				'outros' => $movimentacaoDespesa[1][1][7][0]->getTotalDepesaMissao()
			
				
		);
		
		
		$arrayCenipaMilitar[] =  array(
		
				'investigacao' => $movimentacaoDespesa[1][2][1][0]->getTotalDepesaMissao(),
				'prevencao' => $movimentacaoDespesa[1][2][2][0]->getTotalDepesaMissao(),
				'administrativo' => $movimentacaoDespesa[2][1][3][0]->getTotalDepesaMissao(),
				'capacitacao' => $movimentacaoDespesa[1][2][4][0]->getTotalDepesaMissao(),
				'operacional' => $movimentacaoDespesa[1][2][5][0]->getTotalDepesaMissao(),
				'representacao' => $movimentacaoDespesa[1][2][6][0]->getTotalDepesaMissao(),
				'outros' => $movimentacaoDespesa[1][2][7][0]->getTotalDepesaMissao()
			
				
		);
		
		
		$arrayCenipaPassagem[] =  array(
		
				'investigacao' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,1),
				'prevencao' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,2),
				'administrativo' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,3),
				'capacitacao' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,4),
				'operacional' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,5),
				'representacao' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,6),
				'outros' => $this->calcularCustoPassagemPorUnidadeMissao(3,1,$anoExercicio,7)
			
				
		);
		
		
		//$naturezaDespesa, $unidade, $exercicio, $naturezaMissao
		
		
				

		
		
		//$naturezaDespesa, $unidade, $exercicio
		$totalNaturezaCivilCenipa = $this->obterSaldoNaturezaDespesaUnidade(1, 1, $anoExercicio);

		$totalNaturezaMilitarCenipa = $this->obterSaldoNaturezaDespesaUnidade(2, 1, $anoExercicio);
	
		$passagemCenipa = $this->obterSaldoNaturezaDespesaUnidade(3, 1, $anoExercicio);
		
		
		
	
		$totalDiariaMilitarCenipa = $totalNaturezaMilitarCenipa[0]->getValorNatureza();
		
		$saldoDiariaMilitarCenipa = $totalNaturezaMilitarCenipa[0]->getSubTotal();
		

		
		$totalDiariaCivilCenipa = $totalNaturezaCivilCenipa[0]->getValorNatureza();
		
		$saldoDiariaCivilCenipa = $totalNaturezaCivilCenipa[0]->getSubTotal();
		
		
		$totalPassagemCenipa = $passagemCenipa[0]->getValorNatureza();
		
		$saldoPassagemCenipa = $passagemCenipa[0]->getSubTotal();
		
		$pacialPassagemCenipa = $totalPassagemCenipa - $saldoPassagemCenipa;
		
		$parcialMilitar = $totalDiariaMilitarCenipa - $saldoDiariaMilitarCenipa;
		
		$parcialCivil = $totalDiariaCivilCenipa - $saldoDiariaCivilCenipa;
		
		$percentualDiariaMilitar = $this->porcentagem_nx($parcialMilitar, $totalDiariaMilitarCenipa);
		
		$percentualDiariaCivil = $this->porcentagem_nx($parcialCivil, $totalDiariaCivilCenipa);
		
		$percentualPassagemCenipa = $this->porcentagem_nx($pacialPassagemCenipa, $totalPassagemCenipa);
		
		
		
		
       return $this->render('base.html.twig', array(
          'title' => 'titulo',
		  
		  ));
		  
    }
	
	
	public function porcentagem_nx ( $parcial, $total ) {
		
			return ( $parcial * 100 ) / $total;
	}
	
	public function obterCalculo($unidade, $naturezaDespesaId, $naturezaMissao){
		
			$movimentacaoDespesa = $this->getDoctrine()
			->getRepository(Calculo::class)
			->findBy(array('naturezaDespesa' => $naturezaDespesaId, 'naturezaMissao' => $naturezaMissao, 'unidade' => $unidade ));
			
			if(count ($movimentacaoDespesa) > 0){
			
			return $movimentacaoDespesa;
			
			}
			else{
				return 0;
			}
	}
	

	public function obterSaldoNaturezaDespesaUnidade($naturezaDespesa, $unidade, $exercicio){
		
		$os = $this->getDoctrine()
        ->getRepository(Despesa::class);
       
	    
		// createQueryBuilder() automatically selects FROM AppBundle:TbNaturezaDepesa
		// and aliases it to "os"
			$query = $os->createQueryBuilder('d')
			->innerJoin('d.tbOrcamento', 'o')
			->innerJoin('d.tbTaxonomiaNaturezaDespesa', 'natureza')
			->innerJoin('o.tbUnidade', 'unidade')

			->where('natureza.id = :natureza')
			->andWhere('o.exercicio = :exercicio')
			->andWhere('unidade.id = :unidade')
			->setParameter('natureza', $naturezaDespesa)
			->setParameter('exercicio', $exercicio)
			->setParameter('unidade', $unidade)
			->getQuery();
			
			return $query->getResult();
	}
	
	public function calcularCustoPassagemPorUnidadeMissao($naturezaDespesa, $unidade, $exercicio, $naturezaMissao){
		
		
		$movimentacaoDespesaPassagem = $this->getDoctrine()
			->getRepository(MovimentacaoPassagem::class)
			->findBy(array('naturezaDespesa' => $naturezaDespesa, 'naturezaMissao' => $naturezaMissao, 'unidade' => $unidade, 'exercicio' => $exercicio ));
			
			$totalPassagem = 0;
			
			if(count($movimentacaoDespesaPassagem) > 0){
			
			foreach($movimentacaoDespesaPassagem as $passagem){
				
				
				$totalPassagem += $passagem->getValorDespesa();
			}
			
			return $totalPassagem;
			
			}
			else {
				
				return 0;
			}
		
		
		
	}
}
