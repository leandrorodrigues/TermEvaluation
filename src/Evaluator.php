<?php
namespace TermEvaluation;

/**
 * Class Evaluator
 * Agrupa métodos responsáveis por avaliar um texto de busca em um tipo
 * @package TermEvaluation
 */
class Evaluator
{
	/**
	 * Retorna um objeto preenchido com os dados que foram extraídos do texto.
	 * @param $term termo buscado
	 *
	 * @return mixed objeto extraído
	 */
	public function evaluate($term) {
		$type = $term;

		//data ptbr
		if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{2,4}$/', $term)) {
			list($d, $m, $y) = explode('/', $term);
			$y = str_pad($y, 4, '19', STR_PAD_LEFT);

			return new \DateTime("$d-$m-$y");
		}

		//em caso de data com -
		if (preg_match('/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/', $term)) {
			return new \DateTime($term);
		}

		//em caso de número inteiro
		if (preg_match('/^[\-\+]?[0-9]*$/', $term)) {
			return intval($term);
		}

		//em caso de número float
		if (preg_match('/^[\-\+]?[0-9]*([\.,][0-9]+)?$/', $term)) {
			$term = str_replace(',', '.', $term);

			return floatval($term);
		}

		return $type;
	}
}