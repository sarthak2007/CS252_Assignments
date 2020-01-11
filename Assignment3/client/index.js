import React, { Component } from 'react';
import {
  AppRegistry
} from 'react-native';

import Login from './src/screens/Login';
import Sign from './src/screens/Sign';
import Secured from './src/screens/Secured';
import Home from './src/screens/Home';
import Add from './src/screens/Add';
import Guest from './src/screens/Guest';

class ReactNativeStormpath extends Component {

  state = {
    isLoggedIn: false,
    page: 0,
    blapage: 0,
    id : ''
  }

  render() {
  	if(this.state.page == 0){
  		return <Home 
          onLogPress={() => this.setState({page: 1})}
          onSignPress={() => this.setState({page: 2})}
          onguest={() => this.setState({page: 3})}
        />;
  	}
  	if(this.state.page == 2){
  		return <Sign 
          onSignUpPress={() => this.setState({page: 0})}
          onHomesPress={() => this.setState({page: 0})}
        />;
  	}
  	if(this.state.page == 3){
  		return <Guest 
          onbackPress={() => this.setState({page: 0})}
        />;
  	}
  	if(this.state.page == 1){
	    if (this.state.isLoggedIn){ 

	    	if(this.state.blapage == 0){
		      return <Secured token = {this.state.id}
		          onLogoutPress={() => this.setState({isLoggedIn: false, page: 0})}
		          onAddPress={() => this.setState({blapage: 1})}
		        />;
		    }
		    if(this.state.blapage == 1){
		      return <Add token = {this.state.id}
		          onBackPress={() => this.setState({blapage: 0})}
		        />;
		    }

	    }
	    else 
	      return <Login 
	          onLoginPress={(user) => this.setState({isLoggedIn: true, id: user, blapage: 0})}
	          onHomePress={() => this.setState({page: 0})}
	        />;
    }
  }

}

AppRegistry.registerComponent('ReactNativeStormpath' , () => ReactNativeStormpath );