<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Game extends Component
{
    public function render()
    {
        return view('livewire.game');
    }
    public $status ='waiting';
    public function start()
    {
        $this->status='trying';
    }
    public $words=[
        'dog',
        'cat',
        'horse',
    ];
    public $currentWord;
    public $solvedWords = [];
    
    public function start()
    {
        $this->status='trying';
        $this->generateCurrentWord();
    }
    
    public function generateCurrentWord()
    {
        $unsolvedWords = array_filter($this->words, function($word){ // get words that aren't inluded in $solvedWord
            return !in_array($word, $this->solvedWords);
        });
        $unsolvedWords = array_values($unsolvedWords);
        $randomIndex = rand(0, count($unsolvedWords) - 1);
        $this->currentWord = $unsolvedWords[$randomIndex];
    }
    
    public $typingText='';
    
    public function render()
    {
        if ($this->typingText === $this->currentWord){
            array_push($this->solvedWords, $this->currentWord);
            if (count($this->words) === count($this->solvedWords)) {
                $this->status = 'done';
            }else{
                $this->generateCurrentWord();
            }
            $this->typingText = '';
            
        }
        return view('livewire.game');
    }
    
    public function getQuestionNumberProperty()
    {
        if(count($this->words) === count($this->solvedWords)){
            return count($this->solvedWords);
        } else {
            return count($this->solvedWords) + 1;
        }
    }
}