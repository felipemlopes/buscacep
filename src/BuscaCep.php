<?php

namespace Faacsilva\BuscaCep;

use Exception;
use Illuminate\Support\Facades\Log;
use Faacsilva\BuscaCep\Exceptions\BuscaCepException;

class BuscaCep
{
    /**
     * Componentes de terceiros para consulta de CEPs
     *
     * @var array
     */
    protected $services = [
        'Faacsilva\ViaCep\ViaCep',
        'Faacsilva\CepAberto\CepAberto',
    ];

    /**
     * Busca um endereço usando o Cep
     *
     * @param string $cep
     * @return void
     */
    public function buscar($cep)
    {
        $totalServices = count($this->services);
        $counter       = 0;

        foreach($this->services as $service){
            $collection = $this->runner($service, ['cep' => $cep]);

            if($collection === false){
                $counter++;
                continue;
            }
            
            $counter = 0;
            return $collection;
            break;
        }

        if($counter === $totalServices)
            throw new BuscaCepException('Whoops! Algo de inesperado aconteceu com a busca de CEPs.', 500);
    }

    /**
     * Aciona o componente da API de terceiros para obter o cep.
     *
     * @param string $service
     * @param array  $args
     * @return void
     */
    protected function runner($service, $args=[])
    {
        try {
            $client = new $service;

            return $client->buscar($args['cep']);
        }
        catch(Exception $e){
            Log::error("{$service} has failed, calling next.");
            return false;
        }
    }
}