CODE_CHANGES = getGitChanges()
pipeline {
	
	agent any
	
  stages {

    stage("build") {
      when {
          expression {
	      BRANCH_NAME == 'main' && CODE_CHANGES == true
	      }
	  }
      steps {
 	echo 'building'

	}
     }

     stage("test") {
        when {
	    expression {
	        BRANH_NAME == 'main'
	steps {
        	echo 'Testing'

	}
     }
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

}
}
