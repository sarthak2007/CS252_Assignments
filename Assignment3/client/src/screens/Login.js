import React, { Component } from 'react';
import {
    ScrollView,
    Text,
    TextInput,
    View,
    Button,
    Alert,
    ActivityIndicator
} from 'react-native';
import {AsyncStorage} from 'react-native';

export default class Login extends Component {

    state = {
        username: '',
        password: '',
        isLoggingIn: false,
        message: ''
    }

    // _storeData = async () => {
    //                   try {
    //                     await AsyncStorage.setItem('username', this.state.username);
    //                   } catch (error) {
    //                     // Error saving data
    //                   }
    //                 };

    _userLogin = () => {

        this.setState({ isLoggingIn: true, message: '' });

        var proceed = false;
        fetch("http://172.17.73.60:4000/users/authenticate", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: this.state.username,
                    password: this.state.password
                })
            })
            .then((response) => {
                if (response.status==200) proceed = true;
                return response;
            })
            .then((response) => response.json())
            .then((response) => {
                if (response.status==200) proceed = true;
                else this.setState({ message: response.message });
            })
            .then(() => {
                this.setState({ isLoggingIn: false })
                if (proceed) {
                    
                    // this._storeData;
                    this.props.onLoginPress(this.state.username);}
            })
            .catch(err => {
                this.setState({ message: err.message });
                this.setState({ isLoggingIn: false })
            });
    }

    clearUsername = () => {
        this._username.setNativeProps({ text: '' });
        this.setState({ message: '' });
    }

    clearPassword = () => {
        this._password.setNativeProps({ text: '' });
        this.setState({ message: '' });
    }

    _userhome = () => {
        this.props.onHomePress();
    }

    render() {
        return (
            <View style={{backgroundColor: '#E1673C',height: 10000}}>
            <ScrollView style={{padding: 20}}>
                <Text 
                    style={{fontSize: 35, marginTop: 100, textAlign: 'center', color:'#3D4E66'}}>
                    LOGIN
                </Text>
                <TextInput
                    ref={component => this._username = component}
                    placeholder='Username' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:40}}
                    onChangeText={(username) => this.setState({username})}
                    autoFocus={true}
                    onFocus={this.clearUsername}
                />
                <TextInput 
                    ref={component => this._password = component}
                    placeholder='Password' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:20
                    }}
                    onChangeText={(password) => this.setState({password})}
                    secureTextEntry={true}
                    onFocus={this.clearPassword}
                    onSubmitEditing={this._userLogin}
                />
                {!!this.state.message && (
                    <Text
                        style={{fontSize: 14, color: 'red', padding: 5}}>
                        {this.state.message}
                    </Text>
                )}
                {this.state.isLoggingIn && <ActivityIndicator />}
                <View style={{margin:14}} />
                <Button color="#3D4E66"
                    disabled={this.state.isLoggingIn||!this.state.username||!this.state.password}
                    onPress={this._userLogin}
                    title="Submit"
                />
                <View style={{margin:10}} />
                <Button color="#3D4E66"
                    onPress={this._userhome}
                    title="Home"
                />
          </ScrollView>
          </View>
        )
    }
}