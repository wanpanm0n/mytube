pipeline {
	
	agent any
	
  stages {

    stage("build") {
      
      steps {
 	echo 'building'

	}
     }

     stage("test") {
	steps {
        	echo 'Testing'

	}
     }

     stage("build and deploy") {

       steps {
        echo 'building and deploying'

	}
     }
  }
  post {
     always {
     echo "always"
     }
     sucess{
     echo "success block"

}
