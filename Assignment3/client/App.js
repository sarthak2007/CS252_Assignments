import React, { Component } from 'react';

import Login from './src/screens/Login';
import Secured from './src/screens/Secured';

export default class ReactNativeStormpath extends Component {

  state = {
    isLoggedIn: false
  }

  render() {

    if (this.state.isLoggedIn) 
      return <Secured 
          onLogoutPress={() => this.setState({isLoggedIn: false})}
        />;
    else 
      return <Login 
          onLoginPress={() => this.setState({isLoggedIn: true})}
        />;
  }

}
