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

export default class Sign extends Component {

    state = {
        username: '',
        password: '',
        firstName: '',
        lastName: '',
        message: ''
    }

    _userLogin = () => {

        var proceed = false;
        fetch("http://172.17.73.60:4000/users/register", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: this.state.username,
                    password: this.state.password,
                    firstName: this.state.firstName,
                    lastName: this.state.lastName
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
                if (proceed) this.props.onSignUpPress();
            })
            .catch(err => {
                this.setState({ message: err.message });
            });
    }

    clearFirstName = () => {
        this._firstName.setNativeProps({ text: '' });
        this.setState({ message: '' });
    }

    clearLastName = () => {
        this._lastName.setNativeProps({ text: '' });
        this.setState({ message: '' });
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
        this.props.onHomesPress();
    }

    render() {
        return (
            <View style={{backgroundColor: '#E1673C',height: 10000}}>
            <ScrollView style={{padding: 20}}>
                <Text 
                    style={{fontSize: 35, marginTop: 30, textAlign: 'center', color:'#3D4E66'}}>
                    SIGNUP
                </Text>
                <TextInput
                    ref={component => this._firstName = component}
                    placeholder='Firstname' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:40}}
                    onChangeText={(firstName) => this.setState({firstName})}
                    autoFocus={true}
                    onFocus={this.clearFirstName}
                />
                <TextInput
                    ref={component => this._lastName = component}
                    placeholder='Lastname' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:10}}
                    onChangeText={(lastName) => this.setState({lastName})}
                    onFocus={this.clearLastName}
                />
                <TextInput
                    ref={component => this._username = component}
                    placeholder='Username' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:10}}
                    onChangeText={(username) => this.setState({username})}
                    onFocus={this.clearUsername}
                />
                <TextInput 
                    ref={component => this._password = component}
                    placeholder='Password' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:10}}
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
                <View style={{margin:10}} />
                <Button color="#3D4E66"
                    disabled={this.state.isLoggingIn||!this.state.username||!this.state.password}
                    onPress={this._userLogin}
                    title="Submit"
                />
                <View style={{margin:7}} />
                <Button color="#3D4E66"
                    onPress={this._userhome}
                    title="Home"
                />
          </ScrollView>
          </View>
        )
    }
}