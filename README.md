# Pipeline

## A simple implementation of the Pipeline design pattern 

The pattern is especially usefull in web development where Users think of request in  binary terms (success, failure), but implementation is done in steps. 
E.g. Validate input, Save input, Update counters, Tweet, Respond to User.

## Usage

At the conceptual level, a pipeline is a linked list of tasks. As one taks is done, the next is called and 'handled.' 

So, we can we extend the AbstractHandler (which implements for us the ListInterface) 

```php
class Task1 extends AbstractHandler{

	public  function handle(array& $input){

		echo 'Task1 working...';	

		if($this->getNext()){

			return $this->getNext()->handle($input);	

		}else{
			return true;	
		}

	}
}

class Task2 extends AbstractHandler{

	public function handle(array& $input){

		echo 'Task2..';	

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

//some initial input for the pipeline
$input = [];

$t1->handle($input);

```
but this is clearly a pain! And still entail us with lots of work (Excption, errors, control).

So, lets use the Task class. The Task class is conceptually at a higher level vs a AbstractHandler.
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

			$e = $v->getLastTask()->getException();

			//do something
		}
	}
```
