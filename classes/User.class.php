<?php
	class User
	{
		public $profileCard;
		public $age;
		public $interests;
		public $interestNums;
		public $matchingInterests;
		public $fame;

		function __construct($profileCard, $age, $interests, $interestNums, $matchingInterests, $fame)
		{
			$this->profileCard = $profileCard;
			$this->age = $age;
			$this->interests = $interests;
			$this->interestNums = $interestNums;
			$this->matchingInterests = $matchingInterests;
			$this->fame = $fame;
		}

		function __toString()
		{
			return $this->profileCard . "<br>Age: " . $this->age . "<br>Interests: " . print_r($this->interests, true) . "<br>Total Interests: " . $this->interestNums .
						"<br>Matching interests: " . $this->matchingInterests . "<br>Fame rating: " . $this->fame;
		}
	}
?>