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
import DatePicker from 'react-native-datepicker';

export default class Add extends Component {

    state = {
        username: this.props.token,
        coding: '',
        date: "2019-11-13",
        message: ''
    }

   

    _userLogin = () => {

        var proceed = false;
        fetch("http://172.17.73.60:8000/users/register", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: this.state.username,
                    coding: this.state.coding,
                    date: this.state.date
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
                if (proceed) this.props.onBackPress();
            })
            .catch(err => {
                this.setState({ message: err.message });
            });
    }

    clearcoding = () => {
        this._coding.setNativeProps({ text: '' });
        this.setState({ message: '' });
    }

    cleardate = () => {
        this._date.setNativeProps({ text: '' });
        this.setState({ message: '' });
    }

    _userhome = () => {
        this.props.onBackPress();
    }

    render() {
        return (
            <View style={{backgroundColor: '#E1673C',height: 10000}}>
            <ScrollView style={{padding: 20}}>
                <Text 
                    style={{fontSize: 35, marginTop: 100, textAlign: 'center', color:'#3D4E66'}}>
                    Add the Competition
                </Text>
                <TextInput
                    ref={component => this._coding = component}
                    placeholder='Coding Competition' style={{paddingTop: 10,fontSize: 25,borderWidth: 3, color:"#3D4E66",
                        borderColor:"#3D4E66", marginTop:40}}
                    onChangeText={(coding) => this.setState({coding})}
                    autoFocus={true}
                />

                <DatePicker
                    style={{width: 350, marginTop:20, borderColor: '#3D4E66'}}
                    date={this.state.date}
                    mode="date"
                    placeholder="Select date"
                    format="YYYY-MM-DD"
                    minDate="2019-05-01"
                    maxDate="2021-06-01"
                    confirmBtnText="Confirm"
                    cancelBtnText="Cancel"
                    customStyles={{
                      dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                      },
                      dateInput: {
                        marginLeft: 36,
                        borderColor: '#3D4E66',
                        borderWidth: 3
                      }
                      // ... You can check the source to find the other keys.
                    }}
                    onDateChange={(date) => {this.setState({date: date})}}
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
                    disabled={!this.state.coding||!this.state.date}
                    onPress={this._userLogin}
                    title="Submit"
                />
                <View style={{margin:10}} />
                <Button color="#3D4E66"
                    onPress={this._userhome}
                    title="Back"
                />
          </ScrollView>
          </View>
        )
    }
}