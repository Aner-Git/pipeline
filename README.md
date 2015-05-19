# Pipeline

## A simple implementation of the Pipeline design pattern 

The pattern is especially usefull in web development where Users think of request in  binary terms (success, failure), but implementation is done in steps. 
E.g. Validate input, Save input, Update counters, Tweet, Respond to User.

## Usage

At the basic, a pipeline is just a linked list of tasks. 

So, the HandlerInterface (which defines the commonality for a task) has 3 methods

```php
interface HandlerInterface{

	function handle(array& $input);

	//for list operation	
	function setNext(HandlerInterface $h);	

	//for list operation
	function getNext();	

}
````


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
but this is clearly a pain! So, lets use the Task class. Conceptually a higher level vs a Handler.
We'll also use the Pipeline class to 'simplify' the pipleline operations


```php
class MyTask extends Task{

	protected function process(array& $input){
		echo '1..';	
		return true;
	}
}

class MyTask2 extends Task{

	protected function process(array& $input){
		echo '2..';
		//handler excpetion	

		throw new \Exception('opps, issue...');

		return true;
	}
}

	$v = new Pipeline;
	$v->add(new MyTask)
	->add(new MyTask2);	

	$v->start();

	if($v->ended()){

		echo 'ok...all task run successfully';

	}else{
		echo 'not ok...';	
		
		//
		if($v->getLastTask()->isException()){
			//do something
		}
	}
```
