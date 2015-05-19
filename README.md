# Pipeline

## A simple implementation of the Pipeline design pattern 


## Usage

At the basic, a pipeline is just a linked list of tasks. 

So, the handler interface has 3 methods: handle, setNext, getNext 


And you can implement a 'pipeline' like this

```php
class Task1 extends AbstractHandler{

	public  function handle(array& $input){
		echo '1..';	

		if($this->getNext()){

			return $this->getNext()->handle($input);	

		}else{
			return true;	
		}

	}
}

class Task2 extends AbstractHandler{

	public function handle(array& $input){
		echo '2..';	

		if($this->getNext()){

			return $this->getNext()->handle($input);	

		}else{
			return true;	
		}

		return true;
	}
}

$t1 = new Task1;	
$t2 = new Task2;	

$t1->setNext($t2);

$input = [];

$t1->handle($input);

```
but this is clearly a pain!

